<?php

namespace App\TenantBundle\Application\Handler;

use App\TenantBundle\Application\Command\CreateTenantCommand;
use App\TenantBundle\Domain\Model\Tenant;
use App\TenantBundle\Domain\Repository\TenantRepositoryInterface;
use App\TenantBundle\Domain\ValueObject\DatabaseConfiguration;
use App\TenantBundle\Domain\ValueObject\DatabaseName;
use App\TenantBundle\Domain\ValueObject\TenantIdentifier;
use App\TenantBundle\Domain\ValueObject\TenantName;

class CreateTenantHandler
{
    public function __construct(
        private TenantRepositoryInterface $tenantRepository,
    ) {
    }

    public function __invoke(CreateTenantCommand $command): void
    {
        $tenant = Tenant::create(
            TenantIdentifier::fromString($command->identifier),
            TenantName::fromString($command->name),
            DatabaseName::fromString($command->databaseName),
            DatabaseConfiguration::fromArray($command->configuration)
        );

        $this->tenantRepository->save($tenant);
    }
}
