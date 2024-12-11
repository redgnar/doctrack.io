<?php

namespace App\TenantBundle\Infrastructure\Repository;

use App\TenantBundle\Domain\Exception\TenantNotFoundException;
use App\TenantBundle\Domain\Model\Tenant;
use App\TenantBundle\Domain\Repository\TenantRepositoryInterface;
use App\TenantBundle\Infrastructure\Doctrine\Entity\TenantEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Uid\Uuid;

class TenantRepository implements TenantRepositoryInterface
{
    /** @var EntityRepository<TenantEntity> */
    private EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
        /** @var EntityRepository<TenantEntity> $repository */
        $repository = $entityManager->getRepository(TenantEntity::class);
        $this->repository = $repository;
    }

    public function findById(string $id): Tenant
    {
        $entity = $this->repository->find(Uuid::fromString($id));

        if (!$entity) {
            throw new TenantNotFoundException(sprintf('Tenant with ID "%s" not found', $id));
        }

        return $entity->toDomain();
    }

    public function findByIdentifier(string $identifier): Tenant
    {
        $entity = $this->repository->findOneBy(['identifier' => $identifier]);

        if (!$entity) {
            throw new TenantNotFoundException(sprintf('Tenant with identifier "%s" not found', $identifier));
        }

        return $entity->toDomain();
    }

    public function save(Tenant $tenant): void
    {
        $entity = TenantEntity::fromDomain($tenant);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function remove(Tenant $tenant): void
    {
        $entity = $this->repository->find($tenant->getId());
        if ($entity) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
        }
    }
}
