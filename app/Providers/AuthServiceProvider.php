<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Mail\EmailVerification;
use App\Mail\ResetPassword as MailResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Custom mailable for email verification
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new EmailVerification($url))
                ->to($notifiable->email);
        });

        // Custom mailable for password reset
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailResetPassword($token, $notifiable->getEmailForPasswordReset()))
                ->to($notifiable->email);
        });
    }
}
