<?php

namespace App\Providers;


use App\Http\Services\ClientService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Encore\Admin\Config\Config;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Config::load();

        Blade::directive('dateFormat', function ($date, $days = 0) {

           
                    return "<?php echo \Carbon\Carbon::parse($date)->format('d.m.Y'); ?>";
                

            

        });

        Blade::directive('toUnix', function ($date, $days = 0) {

                    return "<?php echo \Carbon\Carbon::parse($date)->timestamp; ?>";

        });

        Blade::directive('dateFormatWithTime', function ($date, $days = 0) {

            return "<?php echo \Carbon\Carbon::parse($date)->format('d.m.Y - H:i'); ?>";

        });

        Blade::directive('dateNow', function () {

            return "<?php echo \Carbon\Carbon::now()->format('d.m.Y'); ?>";

        });

        \URL::forceScheme('https');


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		app('view.finder')->addExtension('xml');
    }
}
