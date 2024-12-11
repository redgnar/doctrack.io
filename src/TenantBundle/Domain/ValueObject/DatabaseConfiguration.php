<?php

namespace App\TenantBundle\Domain\ValueObject;

final class DatabaseConfiguration
{
    private function __construct(
        /**
         * @var array<string, mixed>
         */
        private array $value,
    ) {
    }

    /**
     * @param array<string, mixed> $configuration
     */
    public static function fromArray(array $configuration): self
    {
        return new self($configuration);
    }

    public static function empty(): self
    {
        return new self([]);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->value;
    }
}
