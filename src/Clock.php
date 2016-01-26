<?php

namespace Adamnicholson\Clock;

use Carbon\Carbon;

interface Clock
{
    /**
     * @return Carbon
     */
    public function getCurrentDatetime();

    /**
     * Alias of getCurrentDatetime()
     *
     * @return Carbon
     */
    public function now();
}
