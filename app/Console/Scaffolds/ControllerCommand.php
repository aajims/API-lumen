<?php

namespace App\Console\Scaffolds;

use Symfony\Component\Console\Input\InputOption;

class ControllerCommand extends AbstractCommand
{
    const SUFFIX = 'Controller';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:controller {module} {controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

    /**
     * The console command type.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Handle the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $module = $this->getModuleName();
        $controller = $this->getControllerName();
        $path = $this->getPath($module, $controller);

        if ($this->files->exists($path)) {
            $this->error($this->type . ' already exists.');

            return false;
        }
        $this->files->makeDirectory(dirname($path), 0777, true, true);
        $this->files->put($path, $this->build($module, $controller));

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Get the console command namespace.
     *
     * @param string $module
     * @param string $namespace
     *
     * @return string
     */
    public function getNamespace(string $module, string $namespace = '')
    {
        $module = ucwords(str_singular(strtolower($module)));
        $default = sprintf('Http\%s\Controllers', $module);
        $namespace = $namespace ? ($namespace . $default) : $default;

        return $namespace;
    }

    /**
     * Get the console command module name.
     *
     * @return string
     */
    protected function getModuleName()
    {
        $name = trim($this->argument('module'));

        return $name;
    }

    /**
     * Get the console command controller name.
     *
     * @return string
     */
    protected function getControllerName()
    {
        $name = trim($this->argument('controller'));

        return $name;
    }

    /**
     * Get the destination class path.
     *
     * @param string $module
     * @param string $controller
     *
     * @return string
     */
    protected function getPath(string $module, string $controller)
    {
        $namespace = $this->getNamespace($module);
        $namespace = str_replace('\\', '/', $namespace);
        $controller = $controller . 'Controller.php';
        $path = $this->laravel['path'] . '/' . $namespace . '/' . $controller;

        return $path;
    }

    /**
     * Get the console command template.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return __DIR__ . '/templates/controller.tpl';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'resource',
                null,
                InputOption::VALUE_NONE,
                'Generate a resource controller class.',
            ],
        ];
    }
}
