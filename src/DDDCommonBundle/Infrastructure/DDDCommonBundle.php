<?php

namespace App\DDDCommonBundle\Infrastructure;

use App\DDDCommonBundle\Infrastructure\DependencyInjection\DDDCommonExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DDDCommonBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new DDDCommonExtension();
    }
} 