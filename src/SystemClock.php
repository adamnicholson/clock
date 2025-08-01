<?php

namespace Adamnicholson\Clock;

use DateTimeZone;

class SystemClock implements Clock
{
    /**
     * @var DateTimeZone
     */
    private DateTimeZone $timeZone;

    /**
     * SystemClock constructor.
     * @param DateTimeZone $timeZone
     */
    public function __construct(DateTimeZone $timeZone = null)
    {
        $this->timeZone = $timeZone ?? new DateTimeZone(date_default_timezone_get());
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentDatetime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable('now', $this->timeZone);
    }

    /**
     * {@inheritdoc}
     */
    public function now(): \DateTimeImmutable
    {
        return $this->getCurrentDatetime();
    }
}
