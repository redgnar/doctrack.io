<?php

namespace App\TenantBundle\Infrastructure\Doctrine\Entity;

use App\TenantBundle\Domain\Model\Tenant;
use App\TenantBundle\Domain\ValueObject\DatabaseConfiguration;
use App\TenantBundle\Domain\ValueObject\DatabaseName;
use App\TenantBundle\Domain\ValueObject\TenantIdentifier;
use App\TenantBundle\Domain\ValueObject\TenantName;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'tenants')]
class TenantEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private string $identifier;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(name: 'database_name', type: 'string', length: 255)]
    private string $databaseName;

    /**
     * @var array<string, mixed>
     */
    #[ORM\Column(type: 'json')]
    private array $configuration;

    private function __construct()
    {
    }

    public static function fromDomain(Tenant $tenant): self
    {
        $entity = new self();
        $entity->id = $tenant->getId();
        $entity->identifier = $tenant->getIdentifier()->toString();
        $entity->name = $tenant->getName()->toString();
        $entity->databaseName = $tenant->getDatabaseName()->toString();
        $entity->configuration = $tenant->getConfiguration()->toArray();

        return $entity;
    }

    public function toDomain(): Tenant
    {
        return Tenant::reconstruct(
            $this->id,
            TenantIdentifier::fromString($this->identifier),
            TenantName::fromString($this->name),
            DatabaseName::fromString($this->databaseName),
            DatabaseConfiguration::fromArray($this->configuration)
        );
    }
}
