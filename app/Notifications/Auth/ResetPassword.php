<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;


class ResetPassword extends BaseResetPassword implements ShouldQueue
{
    use Queueable;
}
