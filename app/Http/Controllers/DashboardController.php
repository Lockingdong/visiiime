<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VPageService;

class DashboardController extends Controller
{

    protected $vPageService;

    public function __construct(
        VPageService $vPageService
    )
    {
        $this->vPageService = $vPageService;
    }
    
    public function home()
    {
        $userId = auth()->id();

        $pageList = $this->vPageService->getAvailablePageByUserId($userId);

        return view('components.dashboard.home', compact(
            'pageList'
        ));
    }

}
