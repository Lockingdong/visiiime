<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VBasicLinkItemService;

class VBasicLinkItemController extends Controller
{
    protected $vBasicLinkItemService;

    public function __construct(
        VBasicLinkItemService $vBasicLinkItemService
    )
    {
        $this->vBasicLinkItemService = $vBasicLinkItemService;
    }

    public function linkItemStore(Request $request)
    {

    }
}
