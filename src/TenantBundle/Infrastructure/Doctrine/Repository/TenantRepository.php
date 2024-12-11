<?php

namespace App\TenantBundle\Infrastructure\Doctrine\Repository;

use App\TenantBundle\Entity\Tenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tenant::class);
    }

    public function findByIdentifier(string $identifier): ?Tenant
    {
        return $this->findOneBy(['identifier' => $identifier]);
    }

    public function save(Tenant $tenant): void
    {
        $this->_em->persist($tenant);
        $this->_em->flush();
    }

    public function remove(Tenant $tenant): void
    {
        $this->_em->remove($tenant);
        $this->_em->flush();
    }
} 