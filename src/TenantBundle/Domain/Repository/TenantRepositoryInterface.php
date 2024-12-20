<?php

namespace App\TenantBundle\Domain\Repository;

use App\TenantBundle\Domain\Model\Tenant;

interface TenantRepositoryInterface
{
    public function findById(string $id): Tenant;

    public function findByIdentifier(string $identifier): Tenant;

    public function save(Tenant $tenant): void;

    public function remove(Tenant $tenant): void;
}
