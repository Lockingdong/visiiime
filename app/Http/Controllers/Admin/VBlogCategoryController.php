<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VBlogCategoryService;
use App\Models\VBlogCategory;
use App\Models\VFile;
use App\Services\VFileService;
use App\View\Components\layouts\auth;
use Validator;
use Illuminate\Http\Request;
use Log;

class VBlogCategoryController extends Controller
{

    protected $vBlogCategoryService;
    protected $vFileService;

    const POST_STATUS = [
        VBlogCategory::CATE_AVAILABLE,
        VBlogCategory::CATE_DISABLED,
    ];

    public function __construct(
        VBlogCategoryService $vBlogCategoryService,
        VFileService $vFileService
    )
    {
        $this->vBlogCategoryService = $vBlogCategoryService;
        $this->vFileService = $vFileService;
    }

    public function create(Request $request)
    {

        $vBlogCategory = new VBlogCategory;
        $vBlogCategory->cate_order = 0;
        $vBlogCategory->cate_status = VBlogCategory::CATE_AVAILABLE;

        $action = route('admin.vBlogCategory.store');
        $status = self::POST_STATUS;

        return view('components.admin.vBlogCategory.edit', compact(
            'vBlogCategory',
            'action',
            'status'
        ));
    }


    public function store(Request $request)
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

            $vBlogCategory = new VBlogCategory($request->all());

            $createdPost = $this->vBlogCategoryService->create($vBlogCategory);

            return redirect()->route('admin.vBlogCategory.edit', $createdPost->id)->with('success', '新增成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }


    public function edit(Request $request)
    {
        $vBlogCategoryId = $request->cate_id;
        $vBlogCategory = $this->vBlogCategoryService->find($vBlogCategoryId);

        $action = route('admin.vBlogCategory.update', $vBlogCategory);
        $status = self::POST_STATUS;

        return view('components.admin.vBlogCategory.edit', compact(
            'vBlogCategory',
            'action',
            'status'
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

            $vBlogCategoryId = $request->cate_id;

            $reqData = $request->all();


            $this->vBlogCategoryService->update($vBlogCategoryId, $reqData);

            return redirect()->back()->with('success', '更新成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }


    public function list(Request $request)
    {

        $vBlogCategories = $this->vBlogCategoryService->all();

        return view('components.admin.vBlogCategory.list', compact(
            'vBlogCategories'
        ));
    }
}
