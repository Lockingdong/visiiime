<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VBlogPostService;
use App\Models\VBlogPost;
use App\Models\VFile;
use App\Services\VFileService;
use App\Services\VBlogCategoryService;
use Validator;
use Illuminate\Http\Request;
use Log;

class VBlogPostController extends Controller
{

    protected $vBlogPostService;
    protected $vBlogCategoryService;
    protected $vFileService;

    const POST_STATUS = [
        VBlogPost::POST_AVAILABLE,
        VBlogPost::POST_DISABLED,
    ];

    public function __construct(
        VBlogPostService $vBlogPostService,
        VBlogCategoryService $vBlogCategoryService,
        VFileService $vFileService
    )
    {
        $this->vBlogPostService = $vBlogPostService;
        $this->vBlogCategoryService = $vBlogCategoryService;
        $this->vFileService = $vFileService;
    }

    public function create(Request $request)
    {

        $vBlogPost = new VBlogPost;
        $vBlogPost->post_order = 0;
        $vBlogPost->post_status = VBlogPost::POST_DISABLED;

        $action = route('admin.vBlogPost.store');
        $status = self::POST_STATUS;
        $vBlogCategories = $this->vBlogCategoryService->all();

        return view('components.admin.vBlogPost.edit', compact(
            'vBlogPost',
            'action',
            'status',
            'vBlogCategories'
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

            $vBlogPost = new VBlogPost($request->all());
            $vBlogPost->user_id = auth()->user()->id;

            $createdPost = $this->vBlogPostService->create($vBlogPost);

            return redirect()->route('admin.vBlogPost.edit', $createdPost->id)->with('success', '新增成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }


    public function edit(Request $request)
    {
        $vBlogPostId = $request->post_id;
        $vBlogPost = $this->vBlogPostService->find($vBlogPostId);

        $action = route('admin.vBlogPost.update', $vBlogPost);
        $status = self::POST_STATUS;
        $vBlogCategories = $this->vBlogCategoryService->all();

        return view('components.admin.vBlogPost.edit', compact(
            'vBlogPost',
            'action',
            'status',
            'vBlogCategories'
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

            $vBlogPostId = $request->post_id;

            $reqData = $request->except('post_banner');

            // 如果有圖片 處理上傳圖片
            if($request->hasFile('post_banner')) {

                $vFile = new VFile([
                    'model_id' => $vBlogPostId,
                    'model_name' => 'VBlogPost',
                    'field_name' => 'post_banner',
                    'file_type' => VFile::FILE_IMAGE,
                    'file_path' => 'no path'
                ]);

                $path = $this->vFileService->createImage($vFile, $request->file('post_banner'), 1024);

                $reqData['post_banner'] = $path;
            }

            $this->vBlogPostService->update($vBlogPostId, $reqData);

            return redirect()->back()->with('success', '成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }


    public function list(Request $request)
    {

        $vBlogPosts = $this->vBlogPostService->getAllVBlogPosts();

        return view('components.admin.vBlogPost.list', compact(
            'vBlogPosts'
        ));
    }
}
