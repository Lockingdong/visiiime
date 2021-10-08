<?php

namespace App\Http\Controllers;

use App\Models\VBlogPost;
use App\Repositories\VBlogPostRepository;
use App\Services\VBlogPostService;
use Illuminate\Http\Request;

class VWebController extends Controller
{
    private $vBlogPostService;

    public function __construct(VBlogPostService $vBlogPostService)
    {
        $this->vBlogPostService = $vBlogPostService;
    }

    public function home()
    {
        $title = '首頁';

        return view('components.web.home', compact('title'));
    }

    public function pricing()
    {
        $title = 'Pricing';

        $action = route('subscription.pay');

        return view('components.web.pricing', compact(
            'title',
            'action'
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
        $VBlogPosts = $this->vBlogPostService->getAvalVBlogPosts();

        return view('components.web.blog-list', compact('title', 'VBlogPosts'));
    }

    public function blogShow($id)
    {
        $VBlogPost = $this->vBlogPostService->find($id);
        $title = $VBlogPost->post_title;

        return view('components.web.blog-show', compact('title', 'VBlogPost'));
    }

    public function help()
    {
        $title = 'Help';

        return view('components.web.help', compact('title'));
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
