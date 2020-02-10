<?php

namespace Ozarko\Containerable\Commands;

use Illuminate\Console\Command;
use Ozarko\Containerable\Facades\Container;

class ContainerableInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'containerable:install';

    /**
     * @var string
     */
    protected $root;

    /**
     * @var string
     */
    protected $directoryName = 'Containers';

    /**
         * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->root = app_path(). '/' .$this->directoryName;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $this->rootExists();

        $this->buildDirectoriesStructure();
    }

    private function buildDirectoriesStructure(): void
    {

    }

    /**
     * @throws \Exception
     */
    private function rootExists(): void
    {
        if (! Container::dirIsEmpty($this->root) || file_exists($this->root)) {

            throw new \Exception('Containerable was installed');
        }
    }
}
