<?php

namespace App\TenantBundle\Domain\Model;

use App\DDDCommonBundle\Domain\Model\EventRecorder;
use App\TenantBundle\Domain\Events\TenantCreated;
use App\TenantBundle\Domain\ValueObject\TenantIdentifier;
use App\TenantBundle\Domain\ValueObject\TenantName;
use App\TenantBundle\Domain\ValueObject\DatabaseName;
use App\TenantBundle\Domain\ValueObject\DatabaseConfiguration;
use Symfony\Component\Uid\Uuid;

class Tenant
{
    use EventRecorder;

    private function __construct(
        private Uuid $id,
        private TenantIdentifier $identifier,
        private TenantName $name,
        private DatabaseName $databaseName,
        private DatabaseConfiguration $configuration
    ) {
    }

    public static function create(
        TenantIdentifier $identifier,
        TenantName $name,
        DatabaseName $databaseName,
        DatabaseConfiguration $configuration = null
    ): self {
        $tenant = new self(
            id: Uuid::v4(),
            identifier: $identifier,
            name: $name,
            databaseName: $databaseName,
            configuration: $configuration
        );

        $tenant->recordEvent(new TenantCreated(
            tenantId: $tenant->id->toString(),
            identifier: $tenant->identifier->toString(),
            name: $tenant->name->toString(),
            dataBaseName: $tenant->databaseName->toString(),
            connection: $tenant->configuration->toArray(),
            version: 1,
            eventOccurred: new \DateTimeImmutable()
        ));

        return $tenant;
    }

    public static function recreate(
        Uuid $id,
        TenantIdentifier $identifier,
        TenantName $name,
        DatabaseName $databaseName,
        array $configuration = []
    ): self {
        return new self(
            id: $id,
            identifier: $identifier,
            name: $name,
            databaseName: $databaseName,
            configuration: DatabaseConfiguration::fromArray($configuration)
        );
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getIdentifier(): TenantIdentifier
    {
        return $this->identifier;
    }

    public function getName(): TenantName
    {
        return $this->name;
    }

    public function getDatabaseName(): DatabaseName
    {
        return $this->databaseName;
    }

    public function getConfiguration(): DatabaseConfiguration
    {
        return $this->configuration;
    }
} 