<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VCategory;
use App\Services\VPostService;
use App\Models\VPost;
use App\Models\VFile;
use App\Services\VFileService;
use App\Services\VCategoryService;
use Validator;
use Illuminate\Http\Request;
use Log;

class VPostController extends Controller
{

    protected $vPostService;
    protected $vCategoryService;
    protected $vFileService;

    const POST_STATUS = [
        VPost::POST_AVAILABLE,
        VPost::POST_DISABLED,
    ];

    public function __construct(
        VPostService $vPostService,
        VCategoryService $vCategoryService,
        VFileService $vFileService
    )
    {
        $this->vPostService = $vPostService;
        $this->vCategoryService = $vCategoryService;
        $this->vFileService = $vFileService;
    }

    public function create(Request $request)
    {

        $vPost = new VPost;
        $vPost->post_order = 0;
        $vPost->post_status = VPost::POST_DISABLED;

        $action = route('admin.vPost.store');
        $status = self::POST_STATUS;
        $vCategories = $this->vCategoryService
                            ->getBy(
                                'model_name',
                                VCategory::CATE_MODEL_TYPES[VPost::class]
                            );
        return view('components.admin.vPost.edit', compact(
            'vPost',
            'action',
            'status',
            'vCategories'
        ));
    }


    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'post_title' => 'required',
                'post_content' => 'required',
                'post_status' => 'required',
            ]);

            if($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }

            $vPost = new VPost($request->all());
            $vPost->user_id = auth()->user()->id;

            $createdPost = $this->vPostService->create($vPost);

            return redirect()->route('admin.vPost.edit', $createdPost->id)->with('success', '新增成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }


    public function edit(Request $request)
    {
        $vPostId = $request->post_id;
        $vPost = $this->vPostService->find($vPostId);

        $action = route('admin.vPost.update', $vPost);
        $status = self::POST_STATUS;
        $vCategories = $this->vCategoryService
                            ->getBy(
                                'model_name',
                                VCategory::CATE_MODEL_TYPES[VPost::class]
                            );

        return view('components.admin.vPost.edit', compact(
            'vPost',
            'action',
            'status',
            'vCategories'
        ));

    }


    public function update(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'post_title' => 'required',
                'post_content' => 'required',
                'post_status' => 'required',
            ]);

            if($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }

            $vPostId = $request->post_id;

            $reqData = $request->except('post_banner');

            // 如果有圖片 處理上傳圖片
            if($request->hasFile('post_banner')) {

                $vFile = new VFile([
                    'model_id' => $vPostId,
                    'model_name' => 'VPost',
                    'field_name' => 'post_banner',
                    'file_type' => VFile::FILE_IMAGE,
                    'file_path' => 'no path'
                ]);

                $path = $this->vFileService->createImageVFile($vFile, $request->file('post_banner'), 1024);

                $reqData['post_banner'] = $path;
            }

            $this->vPostService->update($vPostId, $reqData);

            return redirect()->back()->with('success', '成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }


    public function list(Request $request)
    {

        $vPosts = $this->vPostService->getAllVPosts();

        return view('components.admin.vPost.list', compact(
            'vPosts'
        ));
    }
}
