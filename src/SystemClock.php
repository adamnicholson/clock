<?php

namespace Adamnicholson\Clock;

use Carbon\Carbon;
use DateTimeZone;

class SystemClock implements Clock
{
    /**
     * @var DateTimeZone
     */
    private $timeZone;

    /**
     * SystemClock constructor.
     * @param DateTimeZone $timeZone
     */
    public function __construct(DateTimeZone $timeZone = null)
    {
        $this->timeZone = $timeZone ?: new DateTimeZone(date_default_timezone_get());
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentDatetime()
    {
        return new Carbon('now', $this->timeZone);
    }

    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return $this->getCurrentDatetime();
    }
}
