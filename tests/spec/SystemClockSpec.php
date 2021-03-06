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
        $this->getCurrentDatetime()->shouldHaveType(\DateTimeImmutable::class);
    }

    public function it_returns_system_time()
    {
        $this->getCurrentDatetime()->shouldEqualDateTime(new \DateTimeImmutable());
    }

    public function it_returns_time_in_expected_timezone()
    {
        $this->beConstructedWith(new \DateTimeZone('Africa/Harare'));
        $this->getCurrentDatetime()->shouldEqualDateTime(new \DateTimeImmutable('now', new \DateTimeZone('Africa/Harare')));
        $this->getCurrentDatetime()->shouldNotEqualDateTime(new \DateTimeImmutable('now', new \DateTimeZone('Europe/London')));
    }

    public function getMatchers()
    {
        return [
            'equalDateTime' => function(\DateTimeImmutable $subject, \DateTimeImmutable $expected) {
                return
                    $subject->format(DATE_ATOM) === $expected->format(DATE_ATOM)
                    && $subject->getTimezone() == $expected->getTimezone()
                    ;
            },
        ];
    }
}
