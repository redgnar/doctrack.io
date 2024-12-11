<?php

namespace App\TenantBundle\Infrastructure\Repository;

use App\TenantBundle\Domain\Exception\TenantNotFoundException;
use App\TenantBundle\Domain\Model\Tenant;
use App\TenantBundle\Domain\Repository\TenantRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class DoctrineTenantRepository extends ServiceEntityRepository implements TenantRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {

    }

    public function findById(string $id): Tenant
    {
        throw new TenantNotFoundException();
    }

    public function findByIdentifier(string $identifier): Tenant
    {
        throw new TenantNotFoundException();
    }

    public function save(Tenant $tenant): void
    {

    }

    public function remove(Tenant $tenant): void
    {

    }
} 