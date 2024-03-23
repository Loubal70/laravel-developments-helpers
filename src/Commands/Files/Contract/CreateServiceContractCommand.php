<?php

namespace lboulanger\LaravelDevelopmentHelpers\Commands\Files\Contract;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateServiceContractCommand extends GeneratorCommand
{
    public $name = 'make:servicecontractfile';

    protected $type = 'Contract';

    protected function getStub(): string
    {
        return __DIR__.'/../../../../stubs/serviceContract.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}\\Services\\Contracts";
    }

    protected function buildClass($name): string
    {
        $contractName = "{$name}Contract";

        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $contractName)
            ->replaceClass($stub, $contractName);
    }

    /**
     * Get the destination class path.
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name.'Contract').'.php';
    }
}
