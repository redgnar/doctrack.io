<?php

namespace App\TenantBundle\Application\Command;

class CreateTenantCommand
{
    public function __construct(
        public readonly string $identifier,
        public readonly string $name,
        public readonly string $databaseName
    ) {
    }
} 