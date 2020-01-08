<?php
namespace masud\Press;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PressBaseServiceProvider extends ServiceProvider
{
   public function boot(){

   		if ($this->app->runningInConsole()) {
   			$this->registerPublishing();
   		}
		$this->registerResources();
   }

   public function register(){
   		$this->commands([
            Console\ProcessCommand::class,
        ]);
   }


   private function registerResources(){
   	    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
          $this->loadViewsFrom(__DIR__.'/../resources/views', 'press');

          $this->registerRoutes();
   }

   protected function registerPublishing(){
   		$this->publishes([
   			__DIR__.'/../config/press.php' => config_path('press.php'),
   		], 'press-config');
   }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }
    
    /**
     * Get the Press route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'prefix' => Press::path(),
            'namespace' => 'masud\Press\Http\Controllers',
        ];
    }
}