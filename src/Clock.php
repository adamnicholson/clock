<?php

namespace Adamnicholson\Clock;

interface Clock extends \Psr\Clock\ClockInterface
{
    /**
     * @return \DateTimeImmutable
     */
    public function getCurrentDatetime(): \DateTimeImmutable;

    /**
     * Alias of getCurrentDatetime()
     *
     * @return \DateTimeImmutable
     */
    public function now(): \DateTimeImmutable;
}
