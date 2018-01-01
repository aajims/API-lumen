<?php

namespace App\Console\Scaffolds;

use Symfony\Component\Console\Input\InputOption;

class ModelCommand extends AbstractCommand
{
    const SUFFIX = 'Model';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature
        = '
        make:model {database : Name of the database} {model : Name of the model}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model class';

    /**
     * The console command type.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Handle the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $database = $this->getDatabaseName();
        $model = $this->getModelName();
        $path = $this->getPath($database, $model);

        if ($this->files->exists($path)) {
            $this->error($this->type . ' already exists.');

            return false;
        }
        $this->files->makeDirectory(dirname($path), 0777, true, true);
        $this->files->put($path, $this->build($model, $database));

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
        $default = sprintf('Models\%s', $module);
        $namespace = $namespace ? ($namespace . $default) : $default;

        return $namespace;
    }

    /**
     * Get the console command database name.
     *
     * @return string
     */
    protected function getDatabaseName()
    {
        $name = trim($this->argument('database'));

        return $name;
    }

    /**
     * Get the console command model name.
     *
     * @return string
     */
    protected function getModelName()
    {
        $name = trim($this->argument('model'));

        return $name;
    }

    /**
     * Get the destination class path.
     *
     * @param string $database
     * @param string $model
     *
     * @return string
     */
    protected function getPath(string $database, string $model)
    {
        $namespace = $this->getNamespace($database);
        $namespace = str_replace('\\', '/', $namespace);
        $controller = $model . 'Model.php';
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
        return __DIR__ . '/templates/model.tpl';
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
                'Generate a resource model class.',
            ],
        ];
    }
}
