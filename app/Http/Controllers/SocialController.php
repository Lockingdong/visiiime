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

        dd($this->userService->checkoutUserExist($user));
    }

    public function callback($provider)
    {
        $userInfo = Socialite::driver($provider)->user();

        $user = new User();
        $user->name = $userInfo->name;
        $user->email = $userInfo->email;
        $user->provider = $provider;
        $user->provider_id = $userInfo->id;

        try {

            $user = $this->userService->checkoutUserExist($user);
            if($user instanceof User) {

                Auth::login($user);

                return redirect()->route('dashboard');
            }

            $user = $this->userService->create($user);

            /** @var User $user */
            Auth::login($user);

            return redirect()->route('dashboard');

        } catch (\Throwable $exception) {

            \Log::error($exception->getMessage());

            return redirect()->back();
        }

    }

    private function createUser($getInfo, $provider)
    {


        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {

            $user = $this->userService->create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'avatar' => $getInfo->avatar_original
            ]);

            $user->assignRole('p2');
        }
        return $user;
    }
}
