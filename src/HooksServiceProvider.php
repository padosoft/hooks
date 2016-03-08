<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 08/03/2016
 * Time: 12:48
 */

namespace Padosoft\Hooks;
use Illuminate\Support\ServiceProvider;

class HooksServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/.php_cs' => base_path('.php_cs'),
        ]);

        $this->publishes([
            __DIR__ . '/config/pre-commit' => base_path('.git/hooks/pre-commit'),
        ]);

        $this->publishes([
            __DIR__ . '/vendor/padosoft/static-review/config/pre-commit.php' => base_path('hooks/pre-commit.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {


    }

}