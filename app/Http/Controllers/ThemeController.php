<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{



    public function design()
    {
        return view('components.theme.main');
    }
}
