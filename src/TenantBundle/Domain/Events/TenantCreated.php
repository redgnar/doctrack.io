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
        /**
         * @var array<string, mixed>
         */
        public array $configuration,
        public int $version,
        public \DateTimeImmutable $eventOccurred,
    ) {
    }
}
