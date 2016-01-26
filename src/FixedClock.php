<?php

namespace Adamnicholson\Clock;

use Carbon\Carbon;

class FixedClock implements Clock
{
    /**
     * @var \DateTimeImmutable
     */
    private $currentDatetime;

    /**
     * SystemClock constructor.
     * @param \DateTimeImmutable $currentDatetime
     */
    public function __construct(\DateTimeImmutable $currentDatetime = null)
    {
        $this->currentDatetime = $currentDatetime ?: new \DateTimeImmutable();
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentDatetime()
    {
        return Carbon::instance(new \DateTime($this->currentDatetime->format(\DateTime::ATOM)));
    }

    /**
     * {@inheritdoc}
     */
    public function now()
    {
        return $this->getCurrentDatetime();
    }
}
