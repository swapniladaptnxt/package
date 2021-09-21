<?php
namespace Adaptnxt\Flipkart;
use Illuminate\Support\ServiceProvider;
class FlipkartServiceProvider extends ServiceProvider
{

   
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        // $this->loadViewsFrom(__DIR__.'/views','contact');
    }

    public function register()
    {
        //
    }

   
}