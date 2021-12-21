<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VCategory;
use App\Services\VFaqService;
use App\Models\VFaq;
use App\Models\VFile;
use App\Services\VFileService;
use App\Services\VCategoryService;
use Validator;
use Illuminate\Http\Request;
use Log;
use function React\Promise\all;

class VFaqController extends Controller
{

    protected $vFaqService;
    protected $vCategoryService;
    protected $vFileService;

    const FAQ_STATUS = [
        VFaq::FAQ_AVAILABLE,
        VFaq::FAQ_DISABLED,
    ];

    public function __construct(
        VFaqService      $vFaqService,
        VCategoryService $vCategoryService,
        VFileService     $vFileService
    )
    {
        $this->vFaqService = $vFaqService;
        $this->vCategoryService = $vCategoryService;
        $this->vFileService = $vFileService;
    }

    public function create(Request $request)
    {
        $vFaq = new VFaq;
        $vFaq->faq_order = 0;
        $vFaq->faq_status = VFaq::FAQ_DISABLED;

        $action = route('admin.vFaq.store');
        $status = self::FAQ_STATUS;
        $vCategories = $this->vCategoryService
            ->getBy(
                'model_name',
                VCategory::CATE_MODEL_TYPES[VFaq::class]
            );
        return view('components.admin.vFaq.edit', compact(
            'vFaq',
            'action',
            'status',
            'vCategories'
        ));
    }


    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'faq_title' => 'required',
                'faq_content' => 'required',
                'faq_status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }

            $vFaq = new VFaq($request->all());
            $vFaq->user_id = auth()->user()->id;
            $createdFaq = $this->vFaqService->create($vFaq);

            return redirect()->route('admin.vFaq.edit', $createdFaq->id)->with('success', '新增成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }
    }


    public function edit(Request $request)
    {
        $vFaqId = $request->faq_id;
        $vFaq = $this->vFaqService->find($vFaqId);

        $action = route('admin.vFaq.update', $vFaq);
        $status = self::FAQ_STATUS;
        $vCategories = $this->vCategoryService
            ->getBy(
                'model_name',
                VCategory::CATE_MODEL_TYPES[VFaq::class]
            );

        return view('components.admin.vFaq.edit', compact(
            'vFaq',
            'action',
            'status',
            'vCategories'
        ));
    }


    public function update(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'faq_title' => 'required',
                'faq_content' => 'required',
                'faq_status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator->errors()->all());
            }

            $vFaqId = $request->faq_id;

            $reqData = $request->except('faq_banner');

            $this->vFaqService->update($vFaqId, $reqData);

            return redirect()->back()->with('success', '成功');

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return redirect()->back()->withErrors('發生錯誤');
        }

    }


    public function list(Request $request)
    {
        $vFaqs = $this->vFaqService->getAllVFaqs();

        return view('components.admin.vFaq.list', compact(
            'vFaqs'
        ));
    }
}
