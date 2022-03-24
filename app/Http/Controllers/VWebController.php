<?php

namespace App\Http\Controllers;

use App\Enum\VRolePermission;
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

        $section2 = [
            'data' => [
                [
                    'title' => '排版彈性',
                    'content' => '無論是知性優雅、個性化風格、沉穩內斂還是俏皮可愛，你的主題、你做主！彈性編排，完整展現自我風格。',
                    'image' => 'home1'
                ],
                [
                    'title' => '連結私密化',
                    'content' => '國內首創，發佈內容隱私設定；讓你的連結更為私密，只有知道密碼的追蹤者才能進一步觀看資訊。',
                    'image' => 'home2'
                ],
                [
                    'title' => '圖片展示',
                    'content' => '不僅是發布連結，您也可以透過展示圖片吸引用戶點擊您的連結。',
                    'image' => 'home3'
                ],
            ],
        ];

        $section3 = [
            'data' => [
                [
                    'title' => '多種主題',
                    'content' => '提供豐富的主題供您挑選，展現你的獨特風格！',
                    'image' => 'home4'
                ],
                [
                    'title' => '頁面分析',
                    'content' => '分析每一次的頁面瀏覽及連結點擊，讓您更了解您的客群受眾來自何方。',
                    'image' => 'home5'
                ],
                [
                    'title' => '圖片展示',
                    'content' => '提供您連結排程、連結特效等功能，讓您更能體會Visiiime的方便性。',
                    'image' => 'home6'
                ],
            ],
        ];

        return view('components.web.home', compact(
            'title',
            'section2',
            'section3'
        ));
    }

    public function pricing(Request $request)
    {
        $title = 'Pricing';

        $action = route('subscription.pay');

        $periodStartDate = null;

        if (auth()->check() && $request->d !== null) {
            $periodStartDate = $request->d;
        }

        $data = [
            VRolePermission::VIP => [
                '可建立1個人頁',
                '可建立3個主連結',
                '可建立10個一般連結(包含1個圖片展示連結)',
                '可建立3個社群媒體連結',
                '可上傳連結小圖示',
                '可使用連結特效',
                '可設定連結密碼'
            ],
            VRolePermission::VVIP => [
                '包含所有的Visiiime一般方案功能',
                '可建立20個一般連結(包含3個圖片展示連結)',
                '可建立5個社群媒體連結',
                '可使用連結排程功能',
                '可觀看連結點擊分析',
                '可設定Facebook像素、GA(舊版)',
                '可觀看頁面瀏覽分析',
                '可客製化個人主題',
                '可優先體驗Visiiime未來更新之功能'
            ]
        ];

        return view('components.web.pricing', compact(
            'title',
            'action',
            'periodStartDate',
            'data'
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
        // $cate_id = $request->cate_id;

        // $VFaqs = $this->VFaqService->getAvalVFaqs();
        // $VFaqsByCategory = $this->VFaqService->getFaqsByCategory($VFaqs, $cate_id);

        $categories = $this->VCategoryService->getAvailabelCategoriesByType(VCategory::CATE_FAQ);
        // $VCategoryIds = $VCategories->pluck('id')->toArray();

        // $VFaqs = in_array($request->cate_id, $VCategoryIds) ? $VFaqsByCategory : $VFaqs;
        $posts = $this->VPostService->getAvailablePostsByType(VCategory::CATE_FAQ);

        return view('components.web.help', compact(
            'title',
            'categories',
            'posts'
        ));
    }

    public function about()
    {
        $title = '關於我們';

        $about = [
            'team' => [
                [
                    'url' => 'dong',
                    'name' => 'Dong',
                    'title' => 'Creator & Owner',
                    'image' => 'dong'
                ],
                [
                    'url' => 'Chiao',
                    'name' => 'Chiao',
                    'title' => 'Marketing Manager',
                    'image' => 'Chiao'
                ],
                [
                    'url' => 'FruitMi',
                    'name' => 'FruitMi',
                    'title' => 'Front-End & Designer',
                    'image' => 'FruitMi'
                ],
                [
                    'url' => 'mikehsu',
                    'name' => 'Mike Hsu',
                    'title' => 'Back-End Developer',
                    'image' => 'mikehsu'
                ],
            ],
        ];

        return view('components.web.about', compact(
            'title',
            'about'
        ));
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
