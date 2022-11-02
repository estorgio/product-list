<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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

        $this->load_recaptcha_directives();
    }

    private function load_recaptcha_directives()
    {
        Blade::directive('recaptcha_script', function () {
            return '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
        });

        Blade::directive('recaptcha_field', function () {
            return '<div class="g-recaptcha" data-sitekey="' . config('recaptcha.site_key') . '" ' .
                'data-theme="' . config('recaptcha.theme') . '"></div>';
        });
    }
}
