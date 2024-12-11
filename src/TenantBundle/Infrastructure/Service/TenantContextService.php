<?php

namespace App\TenantBundle\Infrastructure\Service;

use App\TenantBundle\Domain\Model\Tenant;
use App\TenantBundle\Domain\Exception\TenantNotFoundException;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class TenantContextService
{
    private ?Tenant $currentTenant = null;
    private array $connections = [];

    public function __construct(
        private readonly string $databaseUrl
    ) {
    }

    public function setCurrentTenant(Tenant $tenant): void
    {
        $this->currentTenant = $tenant;
    }

    public function getCurrentTenant(): ?Tenant
    {
        return $this->currentTenant;
    }

    public function getTenantConnection(): Connection
    {
        if (!$this->currentTenant) {
            throw new TenantNotFoundException('No tenant set in context');
        }

        $tenantId = $this->currentTenant->getIdentifier()->toString();

        if (!isset($this->connections[$tenantId])) {
            $this->connections[$tenantId] = $this->createConnection($this->currentTenant);
        }

        return $this->connections[$tenantId];
    }

    private function createConnection(Tenant $tenant): Connection
    {
        return DriverManager::getConnection([
            'url' => $this->buildDatabaseUrl($tenant)
        ]);
    }

    private function buildDatabaseUrl(Tenant $tenant): string
    {
        $params = parse_url($this->databaseUrl);
        $params['path'] = '/' . $tenant->getDatabaseName()->toString();
        
        return $this->buildUrl($params);
    }

    private function buildUrl(array $params): string
    {
        return sprintf(
            '%s://%s:%s@%s:%d%s',
            $params['scheme'],
            $params['user'],
            $params['pass'],
            $params['host'],
            $params['port'] ?? 5432,
            $params['path']
        );
    }
} 