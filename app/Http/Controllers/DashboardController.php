<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VPageService;
use App\Services\VUserSubscriptionService;
use App\Services\VUserSubRecordService;
use App\Services\VSubAuthDataService;
use App\Models\VUserSubscription;
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

        $latestRecord = $this->vUserSubscriptionService->getLatestPaySuccSubscriptionByUserId($userId);

        return view('components.dashboard.userSetting', compact(
            'latestRecord',
            'isVvip'
        ));
    }

    public function userSubscriptionRecord()
    {
        $userId = auth()->id();

        $allSubscriptions = $this->vUserSubscriptionService->getAllAuthSubscriptionsByUserId($userId);

        $latestRecord = $this->vUserSubscriptionService->getLatestPaySuccSubscriptionByUserId($userId);

        $showResubArea = false;
        $periodStartDate = '';

        if($latestRecord !== null && $latestRecord->us_sub_status === VUserSubscription::US_SUB_TERMINATE) {
            $showResubArea = true;
            $periodStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $latestRecord->us_end_at)->addDay()->startOfDay();
        }

        $latestNoAuthRecord = $this->vUserSubscriptionService->getLatestNoAuthSubscriptionByUserId($userId);

        return view('components.dashboard.userSubscriptionRecord', compact(
            'allSubscriptions',
            'showResubArea',
            'periodStartDate',
            'latestNoAuthRecord'
        ));
    }

}
