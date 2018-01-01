<?php

namespace App\Console\Scaffolds;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class AbstractCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * AbstractCommand constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->files = $filesystem;
    }

    /**
     * Replace some placeholder.
     *
     * @param string $subject
     * @param string $class
     * @param string $module
     *
     * @return string
     */
    protected function replace(
        string &$subject,
        string $class,
        string $module = ''
    ) {
        $namespace = $this->laravel->getNamespace();
        $class = ucwords(str_singular($class)) . static::SUFFIX;
        $pattern = '/[A-Za-z]+?Class\b/';

        if ($module) {
            $namespace = $this->getNamespace($module, $namespace);
            if (preg_match('/\bModels\b/', $namespace)) {
                $replacements = [$class];
            } else {
                $replacements = [$class, $module . static::SUFFIX];
            }
        } else {
            $namespace = $this->getNamespace($namespace);
            $replacements = [$class, $namespace . static::SUFFIX];
        }

        $subject = str_replace(
            'ExampleNamespace',
            $namespace,
            $subject
        );
        $subject = preg_replace_array($pattern, $replacements, $subject);

        return $subject;
    }

    /**
     * Build class.
     *
     * @param string $class
     * @param string $module
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function build(string $class, string $module = '')
    {
        $template = $this->files->get($this->getTemplate());
        $template = $this->replace($template, $class, $module);

        return $template;
    }
}
