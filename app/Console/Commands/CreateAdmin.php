<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:Admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create am Admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('你想要的帳號(信箱)是?');
        $password = $this->secret('你想要的密碼是？');
        $passworddc = $this->secret('請再次輸入你想要的密碼');
        $counter = 0;

        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $this->info($validator->errors());
            exit();
        }

        while ($counter >= 0) {
            if ($password == $passworddc) {
                $user = User::create([
                    'name' => 'admin',
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => User::ADMIN
                ]);

                event(new Registered($user));
                $this->info('帳號建立成功');
                $counter = -1;
            } else {
                $passworddc = $this->secret('密碼不同請再次輸入');
                $counter += 1;
                if ($counter >= 3) {
                    $this->info('建立失敗大俠請重新來過~');
                    exit;
                }
            }
        }
    }
}
