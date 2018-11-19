<?php

namespace Adamnicholson\Clock;

interface Clock
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
