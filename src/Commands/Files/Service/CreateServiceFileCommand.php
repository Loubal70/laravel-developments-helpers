<?php

namespace lboulanger\LaravelDevelopmentHelpers\Commands\Files\Service;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

final class CreateServiceFileCommand extends GeneratorCommand
{
    protected $name = 'make:servicefile';
    protected $type = 'Service';


    protected function getStub(): string
    {
        return __DIR__.'/../../../../stubs/serviceWithContract.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $serviceName = str(
            string: $this->argument('name'),
        )
            ->ucfirst();

        return "{$rootNamespace}\\Services";
    }

    protected function buildClass($name): string
    {
        $serviceName = "{$name}Service";

        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $serviceName)
            ->replaceClass($stub, $name);
    }

    protected function replaceClass($stub, $name): string
    {
        $serviceName = "{$name}Service";
        $class = str_replace($this->getNamespace($name).'\\', '', $serviceName);
        $contractName = str_replace($this->getNamespace($serviceName).'\\', '', $name).'Contract';
        $contractNamespace = $this->rootNamespace()."Services\\Contracts\\{$contractName}";

        $replace = [
            '{{ class }}' => $class,
            '{{class}}' => $class,
            '{{ contract }}' => $contractName,
            '{{contract}}' => $contractName,
            '{{ contractNamespace }}' => $contractNamespace,
            '{{contractNamespace}}' => $contractNamespace,
        ];

        return str_replace(array_keys($replace), array_values($replace), $stub);
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name.'Service').'.php';
    }
}
