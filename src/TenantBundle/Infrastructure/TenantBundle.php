<?php

namespace App\TenantBundle\Infrastructure;

use App\TenantBundle\Infrastructure\DependencyInjection\TenantExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TenantBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new TenantExtension();
    }
} 