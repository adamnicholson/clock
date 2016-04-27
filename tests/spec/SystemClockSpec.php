<?php

namespace spec\Adamnicholson\Clock;

use Adamnicholson\Clock\Clock;
use Cake\Chronos\Chronos;
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
        $this->getCurrentDatetime()->shouldHaveType(Chronos::class);
    }

    public function it_returns_system_time()
    {
        $this->getCurrentDatetime()->shouldEqualDateTime(new Chronos());
    }

    public function it_returns_time_in_expected_timezone()
    {
        $this->beConstructedWith(new \DateTimeZone('Africa/Harare'));
        $this->getCurrentDatetime()->shouldEqualDateTime(new Chronos('now', 'Africa/Harare'));
        $this->getCurrentDatetime()->shouldNotEqualDateTime(new Chronos('now', 'Europe/London'));
    }

    public function getMatchers()
    {
        return [
            'equalDateTime' => function(Chronos $subject, Chronos $expected) {
                return
                    $subject->toDateTimeString() === $expected->toDateTimeString()
                    && $subject->getTimezone() == $expected->getTimezone()
                    ;
            },
        ];
    }


}
