<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VPageService;
use App\Services\VUserSubscriptionService;
use App\Services\VUserSubRecordService;
use App\Services\VSubAuthDataService;
use App\Models\VUserSubscription;
use App\Enum\VRolePermission;
use App\Models\VPage;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use Validator;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    protected $vUserSubscriptionService;
    protected $vUserSubRecordService;
    protected $vSubAuthDataService;
    protected $vPageService;

    public function __construct(
        VUserSubscriptionService $vUserSubscriptionService,
        VUserSubRecordService $vUserSubRecordService,
        VSubAuthDataService $vSubAuthDataService,
        VPageService $vPageService
    )
    {
        $this->vUserSubscriptionService = $vUserSubscriptionService;
        $this->vUserSubRecordService = $vUserSubRecordService;
        $this->vSubAuthDataService = $vSubAuthDataService;
        $this->vPageService = $vPageService;
    }
    
    public function home()
    {
        $user = Auth::user();
        $userId = $user->id;
        $role = $user->role;

        $userPageLimit = VRolePermission::V_ROLE_PERMISSIONS[$role][VRolePermission::CAN_USE_V_PAGE_COUNT]['VBasic'];

        $pageList = $this->vPageService->getAvailablePageByUserId($userId);

        $disableCreateLink = $pageList->count() >= $userPageLimit;

        $pageCreateApi = route('vPage.pageCreate');

        return view('components.dashboard.home', compact(
            'pageList',
            'pageCreateApi',
            'userId',
            'disableCreateLink'
        ));
    }

    public function vPageCreate()
    {
        $action = route('dashboard.vPageStore');

        $vPage = new VPage();

        $isCreate = true;

        return view('components.dashboard.vPageCreate', compact(
            'action',
            'vPage',
            'isCreate'
        ));
    }

    public function vPageStore(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'page_url' => 'bail|required|regex:/^[a-zA-Z0-9]+$/|unique:v_pages,page_url|min:3|max:10',
            ], ['regex' => '只能輸入英數字元'])->setAttributeNames([
                'page_url' => '網址名稱'
            ]);
    
            if ($validator->fails()) {
                return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
            }

            $pageUrl = $request->page_url;
            if(in_array($pageUrl, $this->vPageService->getPageUrlBlackList())) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['網址名稱 已經存在 。']);
            }

            $this->vPageService->createPage($pageUrl);

            return redirect()->route('dashboard')->with('success', '新增成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }
        
    }

    public function vPageEdit(Request $request)
    {

        if($request->page_id === null) {
            return redirect()->back();
        }

        $pageId = $request->page_id;
        $action = route('dashboard.vPageUpdate', $pageId);

        $vPage = $this->vPageService->find($pageId);

        $isCreate = false;

        return view('components.dashboard.vPageCreate', compact(
            'action',
            'vPage',
            'isCreate'
        ));
    }

    public function vPageUpdate(Request $request)
    {
        try {

            if($request->page_id === null) {
                return redirect()->back();
            }

            $pageId = $request->page_id;

            $validator = Validator::make($request->all(), [
                'page_url' => 'bail|required|regex:/^[a-zA-Z0-9]+$/|unique:v_pages,page_url,' . $pageId . '|min:3|max:10',
            ], ['regex' => '只能輸入英數字元'])->setAttributeNames([
                'page_url' => '網址名稱'
            ]);
    
            if ($validator->fails()) {
                return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
            }

            $pageUrl = $request->page_url;
            if(in_array($pageUrl, $this->vPageService->getPageUrlBlackList())) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['網址名稱 已經存在 。']);
            }

            $this->vPageService->update($pageId, [
                'page_url' => $pageUrl
            ]);

            return redirect()->route('dashboard')->with('success', '更新成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }
    }

    public function userSetting()
    {
        $userId = auth()->id();

        $isVvip = auth()->user()->role === VRolePermission::VVIP;

        $latestRecord = $this->vUserSubscriptionService->getLatestPaySuccSubscriptionByUserId($userId);

        $emailKey = 'email_key_' . auth()->user()->email;
        $disableEmailButton = Redis::exists($emailKey);

        return view('components.dashboard.userSetting', compact(
            'latestRecord',
            'isVvip',
            'disableEmailButton'
        ));
    }

    public function userSubscriptionRecord()
    {
        $userId = auth()->id();

        $allSubscriptions = $this->vUserSubscriptionService->getAllAuthSubscriptionsByUserId($userId);

        $latestRecord = $this->vUserSubscriptionService->getLatestPaySuccSubscriptionByUserId($userId);

        $showResubArea = false;
        $periodStartDate = '';

        if($latestRecord !== null && $latestRecord->us_sub_status === VUserSubscription::US_SUB_TERMINATE) {
            $showResubArea = true;
            $periodStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $latestRecord->us_end_at)->addDay()->startOfDay();
        }

        $latestNoAuthRecord = $this->vUserSubscriptionService->getLatestNoAuthSubscriptionByUserId($userId);

        return view('components.dashboard.userSubscriptionRecord', compact(
            'allSubscriptions',
            'showResubArea',
            'periodStartDate',
            'latestNoAuthRecord'
        ));
    }

}
