<?php

namespace Ozarko\Containerable\Commands;

use Illuminate\Console\Command;
use Ozarko\Containerable\Facades\Container;

class MakeControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'container:make:controller {name}, {container}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to generate controller for container.';

    /**
     * @var string
     */
    protected $controllerName;

    /**
     * @var string
     */
    protected $container;

    /**
     * Create a new command instance.
     *
     * @return void
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
        $this->controllerName = $this->controllerName ?? $this->argument('name');
        $this->container = $this->container ?? $this->argument('container');

        /** @var string $controllerContent */
        $controllerContent = Container::makeStub(
            ['{{controller-name}}', '{{container-name}}', '{{namespace}}'],
            [$this->controllerName, $this->container, config('containers.namespace')],
            'controller'
        );

        /** @var string $filename */
        $filename = Container::writeFileWithContent(
            $this->controllerName.'.php', $controllerContent,
            ['container_name' => $this->container, 'path' => 'Http/Controllers']
        );

        $this->info('Controller '. $filename .' was generate.');
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setControllerName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setContainerName(string $name): self
    {
        $this->container = $name;

        return $this;
    }
}
