<?php

declare(strict_types=1);

namespace App\TenantBundle\Domain\Events;

final readonly class TenantCreated
{
    public function __construct(
        public string $tenantId,
        public string $identifier,
        public string $name,
        public string $dataBaseName,
        public array $connection,
        public int $version,
        public \DateTimeImmutable $eventOccurred,
    ) {
    }
}
