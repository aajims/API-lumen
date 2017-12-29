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
}
