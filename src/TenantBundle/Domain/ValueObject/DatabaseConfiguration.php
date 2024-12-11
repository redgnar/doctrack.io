<?php

namespace App\TenantBundle\Domain\ValueObject;

final class DatabaseConfiguration
{
    private function __construct(private array $value)
    {
    }

    public static function fromArray(array $configuration): self
    {
        return new self($configuration);
    }

    public static function empty(): self
    {
        return new self([]);
    }

    public function toArray(): array
    {
        return $this->value;
    }
} 