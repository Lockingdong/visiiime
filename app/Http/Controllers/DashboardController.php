<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VPageService;
use App\Services\VUserSubscriptionService;
use App\Services\VUserSubRecordService;
use App\Services\VSubAuthDataService;
use App\Enum\VRolePermission;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    protected $vUserSubscriptionService;
    protected $vUserSubRecordService;
    protected $vSubAuthDataService;
    protected $vPageService;

    public function __construct(
        VUserSubscriptionService $vUserSubscriptionService,
        VUserSubRecordService $vUserSubRecordService,
        VSubAuthDataService $vSubAuthDataService,
        VPageService $vPageService
    )
    {
        $this->vUserSubscriptionService = $vUserSubscriptionService;
        $this->vUserSubRecordService = $vUserSubRecordService;
        $this->vSubAuthDataService = $vSubAuthDataService;
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


    public function userSetting()
    {
        $userId = auth()->id();

        $isVvip = auth()->user()->role === VRolePermission::VVIP;

        $latestRecord = $this->vUserSubscriptionService->findLatestSubscriptionByUserId($userId);

        return view('components.dashboard.userSetting', compact(
            'latestRecord',
            'isVvip'
        ));
    }

    public function userSubscriptionRecord()
    {
        $userId = auth()->id();

        $latestRecord = $this->vUserSubscriptionService->findLatestSubscriptionByUserId($userId);
        $histRecords = $this->vUserSubRecordService->getHistSubRecordsByUserId($userId);


        $today = Carbon::now()->startOfDay();
        

        // 最新訂閱未過期
        $periodStartDate = null;

        if($latestRecord !== null) {
            $usEndDay = Carbon::createFromFormat('Y-m-d H:i:s', $latestRecord->us_end_at)->startOfDay();
            if($today <= $usEndDay) {
                $periodStartDate = $usEndDay->addDay()->format('Y/m/d'); 
            }
        }

        // if($periodStartDate !== null) {
        //     $date = Carbon::createFromFormat('Y/m/d', $periodStartDate)->startOfDay();
        // }
        // dd($histRecords);
        return view('components.dashboard.userSubscriptionRecord', compact(
            'latestRecord',
            'histRecords',
            'periodStartDate'
        ));
    }

}
