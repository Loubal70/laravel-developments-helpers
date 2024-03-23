<?php

declare(strict_types=1);

namespace lboulanger\LaravelDevelopmentHelpers\Contracts;

use Illuminate\Console\Command;

interface CreateServiceFileActionContract
{
    public function handle(
        string $serviceName,
        string $noContract,
        Command $serviceMakerCommand
    ): void;
}
