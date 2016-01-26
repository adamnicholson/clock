<?php

namespace spec\Adamnicholson\Clock;

use Adamnicholson\Clock\Clock;
use Adamnicholson\Clock\FixedClock;
use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FixedClockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Adamnicholson\Clock\FixedClock');
    }

    public function it_implements_clock()
    {
        $this->shouldHaveType(Clock::class);
    }

    public function it_returns_carbon()
    {
        $this->getCurrentDatetime()->shouldHaveType(Carbon::class);
    }

    public function it_returns_system_time()
    {
        $this->getCurrentDatetime()->shouldEqualDateTime(new Carbon());
    }

    public function it_returns_time_in_expected_timezone()
    {
        $this->beConstructedWith(new \DateTimeImmutable('2020-05-01'));
        $this->getCurrentDatetime()->shouldEqualDateTime(new Carbon('2020-05-01'));
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
