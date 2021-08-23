<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VWebController extends Controller
{
    public function home()
    {
        $title = '首頁';

        return view('components.web.home', compact('title'));
    }
}
