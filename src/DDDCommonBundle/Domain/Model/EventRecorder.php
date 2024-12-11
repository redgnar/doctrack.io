<?php

declare(strict_types=1);

namespace App\DDDCommonBundle\Domain\Model;

trait EventRecorder
{
    /** @var object[] */
    private array $events = [];

    private function recordEvent(object $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return object[]
     */
    public function getRecordedEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}