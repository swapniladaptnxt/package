<?php
namespace Adaptnxt\Flipkart;

use Illuminate\Support\ServiceProvider;

class FlipkartServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(Flipkart::class, function () {
            return new Flipkart(config('flipkart.access_token'));
        });
        $this->app->alias(Flipkart::class, 'flipkart-local');
        $this->publishes([
            __DIR__ . '/Flipkart.php' => config_path('Flipkart.php'),
        ]);
    }
}
