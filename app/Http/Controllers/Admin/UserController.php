<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\VPageService;
use Log;
use App\Models\User;
use App\Enum\VRolePermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{

    protected $userService;
    protected $vPageService;

    public function __construct(
        UserService $userService,
        VPageService $vPageService
    )
    {
        $this->userService = $userService;
        $this->vPageService = $vPageService;
    }

    public function show($pageId)
    {
        $user = $this->userService->find($pageId);
        $userStatus = [
            User::AVAL,
            User::DISA,
            User::DELE,
        ];

        $roles = [
            VRolePermission::VIP,
            VRolePermission::VVIP,
        ];

        $action = route('admin.user.update', $pageId);

        return view('components.admin.user.show', compact(
            'user',
            'userStatus',
            'action',
            'roles'
        ));
    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {

            $userId = $request->user_id;
            $verify = $request->verify;
            $status = $request->user_status;

            $this->userService->update($userId, [
                'user_status' => $status,
                'role' => $request->role,
                'email_verified_at' => ($verify === '1') ? Carbon::now() : null,
            ]);

            if(in_array($status, [User::DISA, User::DELE])) {
                $this->vPageService->disableAllPageByUserId($userId);
            }

            if(in_array($status, [User::AVAL])) {
                $this->vPageService->enableAllPageByUserId($userId);
            }

            DB::commit();
            return redirect()->back()->with('success', 'success');

        } catch (\Throwable $th) {

            DB::rollBack();
            Log::error($th->getMessage());

            return redirect()->back()->with('danger', $th->getMessage());
        }
    }

    public function list(Request $request)
    {
        $email = $request->email;

        if($email !== null) {
            $users = $this->userService->paginateBy('email', $email, 12);
        } else {
            $users = $this->userService->paginate(12);
        }

        return view('components.admin.user.list', compact(
            'users'
        ));
    }

}
