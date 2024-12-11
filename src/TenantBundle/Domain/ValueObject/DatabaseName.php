<?php

namespace App\TenantBundle\Domain\ValueObject;

final class DatabaseName
{
    private function __construct(private string $value)
    {
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
