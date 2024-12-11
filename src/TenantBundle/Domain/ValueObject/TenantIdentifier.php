<?php

namespace App\TenantBundle\Domain\ValueObject;

final class TenantIdentifier
{
    private function __construct(private string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Tenant identifier cannot be empty');
        }
        
        if (strlen($value) > 50) {
            throw new \InvalidArgumentException('Tenant identifier cannot be longer than 50 characters');
        }
        
        if (!preg_match('/^[a-z0-9-]+$/', $value)) {
            throw new \InvalidArgumentException('Tenant identifier can only contain lowercase letters, numbers, and hyphens');
        }
    }

    public static function fromString(string $identifier): self
    {
        return new self($identifier);
    }

    public function toString(): string
    {
        return $this->value;
    }
} 