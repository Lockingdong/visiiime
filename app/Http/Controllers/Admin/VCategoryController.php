<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VCategoryService;
use App\Models\VCategory;
use App\Services\VFileService;
use Validator;
use Illuminate\Http\Request;
use Log;

class VCategoryController extends Controller
{

    protected $vCategoryService;
    protected $vFileService;

    const POST_STATUS = [
        VCategory::CATE_AVAILABLE,
        VCategory::CATE_DISABLED,
    ];

    public function __construct(
        VCategoryService $vCategoryService,
        VFileService $vFileService
    )
    {
        $this->vCategoryService = $vCategoryService;
        $this->vFileService = $vFileService;
    }

    public function create(Request $request)
    {

        $vCategory = new VCategory;
        $vCategory->cate_order = 0;
        $vCategory->cate_status = VCategory::CATE_AVAILABLE;

        $action = route('admin.vCategory.store');
        $status = self::POST_STATUS;
        $model_types = VCategory::CATE_MODEL_TYPES;

        return view('components.admin.vCategory.edit', compact(
            'vCategory',
            'action',
            'status',
            'model_types'
        ));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'cate_name' => 'required',
                'cate_status' => 'required|string',
                'model_name' => 'required|string',
                'cate_order' => 'required|integer'
            ]);

            if($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }
            $vCategory = new VCategory($request->all());

            $createdPost = $this->vCategoryService->create($vCategory);

            return redirect()->route('admin.vCategory.edit', $createdPost->id)->with('success', '新增成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }

    public function edit(Request $request)
    {
        $vCategoryId = $request->cate_id;
        $vCategory = $this->vCategoryService->find($vCategoryId);

        $action = route('admin.vCategory.update', $vCategory);
        $status = self::POST_STATUS;
        $model_types = VCategory::CATE_MODEL_TYPES;

        return view('components.admin.vCategory.edit', compact(
            'vCategory',
            'action',
            'status',
            'model_types'
        ));

    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'cate_name' => 'required',
                'cate_status' => 'required',
            ]);

            if($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }

            $vCategoryId = $request->cate_id;

            $reqData = $request->all();

            $this->vCategoryService->update($vCategoryId, $reqData);

            return redirect()->back()->with('success', '更新成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }

    public function list(Request $request)
    {
        $vCategories = $this->vCategoryService->all();

        return view('components.admin.vCategory.list', compact(
            'vCategories'
        ));
    }
}
