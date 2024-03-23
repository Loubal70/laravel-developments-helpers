<?php

declare(strict_types=1);

namespace lboulanger\LaravelDevelopmentHelpers\Actions;

use Illuminate\Console\Command;
use lboulanger\LaravelDevelopmentHelpers\Contracts\CreateServiceContractFileActionContract;

final class CreateServiceContractFileAction implements CreateServiceContractFileActionContract
{
    public function handle(
        string      $serviceName,
        string      $noContract,
        Command     $serviceMakerCommand): void
    {
        if($noContract){
            return;
        }

        if(config('development-helpers.with_interface')){
            $this->generateContract(serviceName: $serviceName, serviceMakerCommand: $serviceMakerCommand);

            return;
        }
    }

    protected function generateContract(string $serviceName, Command $serviceMakerCommand): void
    {
        $serviceMakerCommand->call('make:servicecontractfile', [
            'name' => $serviceName,
        ]);
    }
}
