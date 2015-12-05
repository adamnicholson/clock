<?php

namespace Adamnicholson\Clock;

use Carbon\Carbon;

interface Clock
{
    /**
     * @return Carbon
     */
    public function getDateTime();
}
