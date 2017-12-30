<?php

namespace ExampleNamespace;

use Illuminate\Console\Command;

class ExampleClass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'example:command {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is console command.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    }
}
