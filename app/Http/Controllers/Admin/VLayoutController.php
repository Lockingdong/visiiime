<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VLayout;
use App\Repositories\VLayoutRepository;
use App\Services\VLayoutService;
use Validator;
use Illuminate\Http\Request;
use Log;

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
                'layout_name' => 'required|string|max:100',
                'layout_display_name' => 'required|string|max:100',
                'layout_code' => 'required|integer',
                'layout_order' => 'required|integer',
                'layout_image' => 'nullable|string',
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

            return redirect()->back()->withErrors('發生了錯誤');
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
                'layout_name' => 'required|string|max:100',
                'layout_display_name' => 'required|string|max:100',
                'layout_code' => 'required',
                'layout_order' => 'required|integer',
                'layout_image' => 'nullable|string',
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

            return redirect()->back()->withErrors('發生了錯誤');
        }
    }


    public function list(Request $request)
    {
        $vLayouts = $this->vLayoutService->getAllLayouts();
        return view('components.admin.vLayout.list', compact('vLayouts'));
    }
}
