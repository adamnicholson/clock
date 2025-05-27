<?php

namespace Adamnicholson\Clock;

interface Clock
{
    public function getCurrentDatetime(): \DateTimeImmutable;

    /**
     * Alias of getCurrentDatetime()
     */
    public function now(): \DateTimeImmutable;
}
