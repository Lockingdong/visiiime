<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\UserService;
use TheSeer\Tokenizer\Exception;

class SocialController extends Controller
{

    protected $userService;

    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function test()
    {
        $user = new User();
        $user->email = 's8809880988@yahoo.com.tw';

        // dd($this->userService->checkoutUserExist($user));
    }

    public function callback($provider)
    {
        $userInfo = Socialite::driver($provider)->user();

        $socialUser = new User();
        $socialUser->name = $userInfo->name;
        $socialUser->email = $userInfo->email;
        $socialUser->provider = $provider;
        $socialUser->provider_id = $userInfo->id;
        $socialUser->role = 'VIP';

        try {

            $user = $this->userService->getUserByEmail($socialUser->email);
            if($user instanceof User) {

                Auth::login($user);
                // $user->createToken('design_token')->plainTextToken;

                return redirect()->route('dashboard');
            }

            /** @var User $user */
            $user = $this->userService->create($socialUser);
            $user->sendEmailVerificationNotification();
            Auth::login($user);
            // $user->createToken('design_token')->plainTextToken;

            return redirect()->route('dashboard');

        } catch (\Throwable $exception) {

            \Log::error($exception->getMessage());

            return redirect()->back()->withErrors('errors', 'error');
        }

    }

}
