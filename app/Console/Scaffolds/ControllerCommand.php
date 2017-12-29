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
        $this->files->put($path, $this->build($module, $controller));

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
    protected function build(string $module, string $controller)
    {
        $template = $this->files->get($this->getTemplate());
        $template = $this->replace($template, $module, $controller);

        return $template;
    }

    /**
     * Replace some placeholder.
     *
     * @param string $subject
     * @param string $namespace
     * @param string $class
     *
     * @return mixed|string
     */
    protected function replace(
        string & $subject,
        string $namespace,
        string $class
    ) {
        $subject = str_replace(
            'ExampleNamespace',
            $this->getNamespace($namespace),
            $subject
        );
        $class = ucwords(str_singular($class)) . self::SUFFIX;
        $pattern = '/[A-Za-z]+?Class\b/';
        $replacements = [$class, $namespace . self::SUFFIX];
        $subject = preg_replace_array($pattern, $replacements, $subject);

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
