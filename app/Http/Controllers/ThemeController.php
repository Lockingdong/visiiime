<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VPageService;
use App\Models\VPage;
use App\View\Components\layouts\auth;

class ThemeController extends Controller
{

    protected $vPageService;

    public function __construct(
        VPageService $vPageService
    )
    {
        $this->vPageService = $vPageService;
    }

    public function themeSelect()
    {
        $confirmRoute = route('theme-confirm');

        return view('components.theme.select', compact(
            'confirmRoute'
        ));
    }

    public function themeConfirm()
    {
        // todo 檢查可使用額度
        $vPage = new VPage();
        $vPage->user_id = auth()->id();
        $vPage->theme_id = 'VBasic';
        // $vPage->page_status = VPage::AVAL;

        $vPage = $this->vPageService->create($vPage);


        return $this->vPageService->create($vPage);
    }

    public function design()
    {
        return view('components.theme.main');
    }
}
