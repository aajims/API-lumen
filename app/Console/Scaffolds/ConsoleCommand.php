<?php

namespace App\Console\Scaffolds;

use Symfony\Component\Console\Input\InputOption;

class ConsoleCommand extends AbstractCommand
{
    const SUFFIX = 'Command';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:console';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:console {console}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new console class';

    /**
     * The console command type.
     *
     * @var string
     */
    protected $type = 'Console';

    public function handle()
    {
        $console = $this->getConsoleName();
        $path = $this->getPath($console);

        if ($this->files->exists($path)) {
            $this->error($this->type . ' already exists.');

            return false;
        }
        $this->files->makeDirectory(dirname($path), 0777, true, true);
        $this->files->put($path, $this->build($console));
    }

    /**
     * Build class.
     *
     * @param string $console
     *
     * @return string|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function build(string $console)
    {
        $template = $this->files->get($this->getTemplate());
        $template = $this->replace($template, $console);

        return $template;
    }

    protected function replace(string &$subject, string $console)
    {
        $namespace = $this->laravel->getNamespace();
        $subject = str_replace(
            'ExampleNamespace',
            $this->getNamespace($namespace),
            $subject
        );
        $class = ucwords(str_singular($console)) . self::SUFFIX;
        $pattern = '/[A-Za-z]+?Class\b/';
        $replacements = [$class, $namespace . self::SUFFIX];
        $subject = preg_replace_array($pattern, $replacements, $subject);

        return $subject;
    }

    /**
     * Get the console command console name.
     *
     * @return string
     */
    protected function getConsoleName()
    {
        $name = trim($this->argument('console'));

        return $name;
    }

    /**
     * Get the destination class path.
     *
     * @param string $console
     *
     * @return string
     */
    protected function getPath(string $console)
    {
        $namespace = $this->getNamespace();
        $namespace = str_replace('\\', '/', $namespace);
        $console = $console . 'Command.php';
        $path = $this->laravel['path'] . '/' . $namespace . '/' . $console;

        return $path;
    }

    /**
     * Get the console command namespace.
     *
     * @param string $namespace
     *
     * @return string
     */
    public function getNamespace(string $namespace = '')
    {
        $default = 'Console\Commands';
        $namespace = $namespace ? $namespace . $default : $default;

        return $namespace;
    }

    /**
     * Get the console command template.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return __DIR__ . '/templates/console.tpl';
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
                'Generate a resource console class.',
            ],
        ];
    }
}
