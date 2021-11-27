<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use Exception;

class UserController extends Controller
{
    
    public function logout(Request $request)
    {
        try {

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json([
                'status' => 'succ'
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail'
            ], 500);
        } 
    }


    public function verifyEmail(Request $request)
    {
        try {

            // dd($request->all());

            // todo
            if($request->_token === null) {
                throw new Exception('no token given');
            }

            $request->user()->sendEmailVerificationNotification();

            return response()->json([
                'status' => 'succ'
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail'
            ], 500);
        }
    }
}
