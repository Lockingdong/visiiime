<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VPage;
use App\Models\User;
use App\Models\VTheme;
use Illuminate\Support\Str;


class VPageController extends Controller
{

    public function create(Request $request)
    {

        $themeCode = $request->get('theme_code');
        $pageUrl = $request->get('page_url');

        $userId = User::first()->id;
        $themeId = VTheme::where('theme_code', $themeCode)->first()->id;

        return VPage::create([
            'user_id' => $userId,
            'theme_id' => $themeId,
            'page_status' => VPage::AVAL,
            'page_url' => $pageUrl
        ]);

    }
}
