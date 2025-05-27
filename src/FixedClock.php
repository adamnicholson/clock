<?php

namespace Adamnicholson\Clock;

use Cake\Chronos\Chronos;

class FixedClock implements Clock
{
    /**
     * @var \DateTimeImmutable
     */
    private \DateTimeImmutable $currentDatetime;

    public function __construct(\DateTimeImmutable $currentDatetime = null)
    {
        $this->currentDatetime = $currentDatetime ?? new \DateTimeImmutable();
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentDatetime(): \DateTimeImmutable
    {
        return $this->currentDatetime;
    }

    /**
     * {@inheritdoc}
     */
    public function now(): \DateTimeImmutable
    {
        return $this->getCurrentDatetime();
    }
}
