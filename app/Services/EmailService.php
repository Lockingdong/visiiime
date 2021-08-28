<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailService
{
    public static function sendEmails(Mailable $email, array $accounts)
    {
        // 驗證 email
        [$validAccounts, $invalidAccounts] = self::validateEmails($accounts);
        
        if ( ! empty($invalidAccounts) ) {
            \Log::error('invalid email occured', [
                'accounts' => $invalidAccounts,
            ]);
        }
        if (empty($validAccounts)) {
            throw new \Exception('no valid email to send');
        }

        Mail::to($validAccounts['to'] ?? [])
            ->cc($validAccounts['cc'] ?? [])
            ->bcc($validAccounts['bcc'] ?? [])
            ->send($email);
    }

    private static function validateEmails($accountArr)
    {
        $validAccounts = [];
        $invalidAccounts = [];

        foreach ($accountArr as $key => $accounts) {
            foreach ($accounts as $account) {
                $validator = Validator::make(['email' => $account], [
                    'email' => 'required|email',
                ]);
                if ($validator->fails()) {
                    $invalidAccounts[$key][] = $account;
                } else {
                    $validAccounts[$key][] = $account;
                }
            }
        }

        return [$validAccounts,  $invalidAccounts];
    }
}