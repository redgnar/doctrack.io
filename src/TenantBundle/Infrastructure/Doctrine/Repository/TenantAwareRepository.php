<?php

namespace App\TenantBundle\Infrastructure\Doctrine\Repository;

use App\TenantBundle\Infrastructure\Service\TenantContextService;
use Doctrine\DBAL\Connection;

abstract class TenantAwareRepository
{
    public function __construct(
        protected TenantContextService $tenantContext,
    ) {
    }

    protected function getConnection(): Connection
    {
        return $this->tenantContext->getTenantConnection();
    }
}
