<?php

namespace App\Http\Controllers;

use App\Models\VCategory;
use App\Models\VFaq;
use App\Services\VCategoryService;
use App\Services\VFaqService;
use App\Services\VPostService;
use Illuminate\Http\Request;

class VWebController extends Controller
{
    private $VPostService;
    private $VFaqService;
    private $VCategoryService;

    public function __construct(
        VPostService $VPostService,
        VFaqService $VFaqService,
        VCategoryService $VCategoryService
    ) {
        $this->VPostService = $VPostService;
        $this->VFaqService = $VFaqService;
        $this->VCategoryService = $VCategoryService;
    }

    public function home()
    {
        $title = '首頁';

        return view('components.web.home', compact('title'));
    }

    public function pricing(Request $request)
    {
        $title = 'Pricing';

        $action = route('subscription.pay');

        $periodStartDate = null;

        if (auth()->check() && $request->d !== null) {
            $periodStartDate = $request->d;
        }

        return view('components.web.pricing', compact(
            'title',
            'action',
            'periodStartDate'
        ));

    }

    public function selectPlan()
    {
        $title = '選擇方案';

        return view('components.web.select-plan', compact('title'));
    }

    public function blogList()
    {
        $title = 'Blog';
        $VPosts = $this->VPostService->getAvalVPosts();

        return view('components.web.blog-list', compact('title', 'VPosts'));
    }

    public function blogShow($id)
    {
        $VPost = $this->VPostService->find($id);
        $title = $VPost->post_title;

        return view('components.web.blog-show', compact('title', 'VPost'));
    }

    public function help(Request $request)
    {
        $title = 'Help';
        $cate_id = $request->cate_id;

        $VFaqs = $this->VFaqService->getAvalVFaqs();
        $VFaqsByCategory = $this->VFaqService->getFaqsByCategory($VFaqs, $cate_id);

        $VCategories = $this->VCategoryService
                            ->getFaqCategories(
                                VCategory::CATE_MODEL_TYPES[VFaq::class]
                            );
        $VCategoryIds = $VCategories->pluck('id')->toArray();

        $VFaqs = in_array($request->cate_id, $VCategoryIds) ? $VFaqsByCategory : $VFaqs;

        return view('components.web.help', compact('title', 'VFaqs', 'VCategories', 'cate_id'));
    }

    public function about()
    {
        $title = '關於我們';

        return view('components.web.about', compact('title'));
    }

    public function terms()
    {
        $title = '服務條款';

        return view('components.web.terms', compact('title'));
    }

    public function privacy()
    {
        $title = '隱私權政策';

        return view('components.web.privacy', compact('title'));
    }

    public function contact()
    {
        $title = '聯絡我們';

        return view('components.web.contact', compact('title'));
    }

    public function career()
    {
        $title = 'Career';

        return view('components.web.career', compact('title'));
    }
}
