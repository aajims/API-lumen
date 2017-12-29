<?php

namespace App\Providers;

use App\Console\Scaffolds\ControllerCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{

    /**
     * Some development environment commands.
     *
     * @var array
     */
    protected $devCommands
        = [
            'Controller' => 'command.controller.make',
        ];

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->registerCommand($this->devCommands);
    }

    /**
     * Register some commands.
     *
     * @param array $commands
     */
    protected function registerCommand(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            $method = "register{$command}Command";
            call_user_func_array([$this, $method], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register controller command.
     */
    private function registerControllerCommand()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->singleton('command.controller.make', function ($app) {
                return new ControllerCommand($app['files']);
            });
        }
    }
}
