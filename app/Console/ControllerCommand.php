<?php

namespace App\Console;

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
     * The name and signature of the console command.
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
     * @return bool|mixed
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
        $this->files->put($path, $this->buildClass($module, $controller));

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Get the console command namespace.
     *
     * @param string $module
     * @param bool   $isDir
     *
     * @return mixed
     */
    public function getNamespace(string $module, $isDir = false)
    {
        $ns = $this->laravel->getNamespace();

        $module = 'Http\\' . ucfirst(str_singular($module)) . '\\Controllers';
        $ns = $isDir ? $module : ($ns . '\\' . $module);
        $namespace = str_replace('\\\\', '\\', $ns);

        return $namespace;
    }

    /**
     * Build class.
     *
     * @param string $module
     * @param string $controller
     *
     * @return mixed|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass(string $module, string $controller)
    {
        $template = $this->files->get($this->getTemplate());
        $template = $this->replaceNamespace($template, $module);
        $template = $this->replaceClass($template, $controller);

        return $template;
    }

    /**
     * Replace namespace name.
     *
     * @param string $subject
     * @param string $namespace
     *
     * @return mixed
     */
    protected function replaceNamespace(string & $subject, string $namespace)
    {
        $subject = str_replace(
            'ExampleNamespace',
            $this->getNamespace($namespace),
            $subject
        );

        return $subject;
    }

    /**
     * Replace class name.
     *
     * @param string $subject
     * @param string $class
     *
     * @return mixed
     */
    protected function replaceClass(string & $subject, string $class)
    {
        $controller = ucwords(str_singular($class)) . self::SUFFIX;
        $subject = str_replace(
            'ExampleController',
            $controller,
            $subject
        );

        return $subject;
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
        $namespace = $this->getNamespace($module, true);
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
