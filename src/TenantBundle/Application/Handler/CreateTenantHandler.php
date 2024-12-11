<?php

namespace App\TenantBundle\Application\Handler;

use App\TenantBundle\Application\Command\CreateTenantCommand;
use App\TenantBundle\Domain\Model\Tenant;
use App\TenantBundle\Domain\Repository\TenantRepositoryInterface;
use App\TenantBundle\Domain\ValueObject\DatabaseName;

class CreateTenantHandler
{
    public function __construct(
        private TenantRepositoryInterface $tenantRepository
    ) {
    }

    public function __invoke(CreateTenantCommand $command): void
    {
        $tenant = Tenant::create(
            $command->identifier,
            $command->name,
            DatabaseName::fromString($command->databaseName)
        );

        $this->tenantRepository->save($tenant);
    }
} 