<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VLayoutService;
use Illuminate\Http\Request;

class VLayoutController extends Controller
{

    protected $vLayoutService;

    public function __construct(
        VLayoutService $vLayoutService
    )
    {
        $this->vLayoutService = $vLayoutService;
    }

    public function availableLayouts(Request $request)
    {
        $themeName = $request->themeName;

        $layouts = $this->vLayoutService->getAvailableLayoutsByThemeName($themeName);

        $result = $this->vLayoutService->layoutsOriFormatter($layouts);

        return response()->json([
            'status' => 'succ',
            'data' => $result
        ], 200);
    }
}
