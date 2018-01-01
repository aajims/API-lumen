<?php

namespace App\Providers;

use App\Console\Scaffolds\ConsoleCommand;
use App\Console\Scaffolds\ControllerCommand;
use App\Console\Scaffolds\ModelCommand;
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
            'Console'    => 'command.console.make',
            'Controller' => 'command.controller.make',
            'Model'      => 'command.model.make',
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
     * Register console command.
     */
    private function registerConsoleCommand()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->singleton('command.console.make', function ($app) {
                return new ConsoleCommand($app['files']);
            });
        }
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

    /**
     * Register model command.
     */
    private function registerModelCommand()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->singleton('command.model.make', function ($app) {
                return new ModelCommand($app['files']);
            });
        }
    }
}
