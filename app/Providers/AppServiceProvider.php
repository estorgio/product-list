<?php

namespace App\Providers;

use App\Mail\EmailVerification;
use App\Mail\ResetPassword as MailResetPassword;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        Blade::directive('format_time', function ($expression) {
            return "<?php echo date('F j, Y - g:i A', strtotime($expression)) ; ?>";
        });

        // Custom mailable for email verification
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new EmailVerification($url))
                ->to($notifiable->email);
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailResetPassword($token, $notifiable->getEmailForPasswordReset()))
                ->to($notifiable->email);
        });
    }
}
