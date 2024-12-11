<?php

namespace App\TenantBundle\Presentation\EventListener;

use App\TenantBundle\Infrastructure\Repository\TenantRepository;
use App\TenantBundle\Infrastructure\Service\TenantContextService;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TenantRequestListener
{
    public function __construct(
        private readonly TenantRepository $tenantRepository,
        private readonly TenantContextService $tenantContext,
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        $tenantId = $request->headers->get('X-Tenant-ID');

        if (!$tenantId) {
            return;
        }

        $tenant = $this->tenantRepository->findByIdentifier($tenantId);

        $this->tenantContext->setCurrentTenant($tenant);
    }
}
