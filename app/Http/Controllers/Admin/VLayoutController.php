<?php

namespace App\Http\Controllers\Admin;

use App\Enum\VRolePermission;
use App\Http\Controllers\Controller;
use App\Models\VLayout;
use App\Repositories\VLayoutRepository;
use App\Services\VLayoutService;
use Validator;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Carbon;

class VLayoutController extends Controller
{
    protected $vLayout;
    protected $vLayoutService;
    protected $vLayoutRepository;

    const LAYOUT_STATUS = [
        VLayout::AVAILABLE,
        VLayout::DISABLED,
    ];


    public function __construct(
        VLayout $vLayout,
        VLayoutService  $vLayoutService,
        VLayoutRepository $vLayoutRepository
    )
    {
        $this->vLayout = $vLayout;
        $this->vLayoutService = $vLayoutService;
        $this->vLayoutRepository = $vLayoutRepository;
    }

    public function create()
    {
        $vLayout = $this->vLayout;
        $vLayout->layout_order = 0;
        $vLayout->theme_name = VLayout::THEME_NAME;
        $vLayout->layout_status = VLayout::DISABLED;
        $vLayout->layout_role = VRolePermission::VVIP;
        $vLayout->start_at = Carbon::today()->startOfDay();
        $vLayout->end_at = Carbon::createFromFormat('Y-m-d', '2099-12-31')->endOfDay();

        $action = route('admin.vLayout.store');
        $status = self::LAYOUT_STATUS;
        $vLayouts = $this->vLayoutService->all();

        return view('components.admin.vLayout.edit', compact(
            'vLayout',
            'action',
            'status',
            'vLayouts'
        ));
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'layout_bg_name' => 'required|string|max:100',
                'layout_display_name' => 'required|string|max:100',
                'layout_code' => 'required',
                'layout_order' => 'required|integer',
                'layout_setting' => 'required|string',
                'layout_status' => 'required|in:'. implode(',', self::LAYOUT_STATUS)
            ]);

            if($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }

            $vLayout = new VLayout($request->all());
            $createdPost = $this->vLayoutService->create($vLayout);

            return redirect()->route('admin.vLayout.edit', $createdPost->id)->with('success', '新增成功');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return redirect()->back()->withInput()->with('danger', $th->getMessage());
        }
    }


    public function edit(Request $request)
    {
        $vLayoutId = $request->layout_id;
        $vLayout = $this->vLayoutService->find($vLayoutId);

        $action = route('admin.vLayout.update', $vLayout);
        $status = self::LAYOUT_STATUS;
        $vLayouts = $this->vLayoutService->all();

        return view('components.admin.vLayout.edit', compact(
            'vLayout',
            'action',
            'status',
            'vLayouts'
        ));
    }


    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'layout_bg_name' => 'required|string|max:100',
                'layout_display_name' => 'required|string|max:100',
                'layout_code' => 'required',
                'layout_order' => 'required|integer',
                'layout_setting' => 'required|string',
                'layout_status' => 'required|in:'. implode(',', self::LAYOUT_STATUS)
            ]);

            if($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }
            $vLayoutId = $request->layout_id;
            $this->vLayoutService->update($vLayoutId, $validator->validated());

            return redirect()->back()->with('success', '成功');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return redirect()->back()->with('danger', $th->getMessage());
        }
    }


    public function list(Request $request)
    {
        $vLayouts = $this->vLayoutService->getAllLayouts();
        return view('components.admin.vLayout.list', compact('vLayouts'));
    }
}
