<?php

namespace spec\Adamnicholson\Clock;

use Adamnicholson\Clock\Clock;
use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SystemClockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Adamnicholson\Clock\SystemClock');
    }

    public function it_implements_clock()
    {
        $this->shouldHaveType(Clock::class);
    }

    public function it_returns_carbon()
    {
        $this->getDateTime()->shouldHaveType(Carbon::class);
    }

    public function it_returns_system_time()
    {
        $this->getDateTime()->shouldEqualDateTime(new Carbon());
    }

    public function it_returns_time_in_expected_timezone()
    {
        $this->beConstructedWith(new \DateTimeZone('Africa/Harare'));
        $this->getDateTime()->shouldEqualDateTime(new Carbon('now', 'Africa/Harare'));
        $this->getDateTime()->shouldNotEqualDateTime(new Carbon('now', 'Europe/London'));
    }

    public function getMatchers()
    {
        return [
            'equalDateTime' => function(Carbon $subject, Carbon $expected) {
                return
                    $subject->toDateTimeString() === $expected->toDateTimeString()
                    && $subject->getTimezone() == $expected->getTimezone()
                    ;
            },
        ];
    }


}
