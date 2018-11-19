<?php

namespace spec\Adamnicholson\Clock;

use Adamnicholson\Clock\Clock;
use Cake\Chronos\Chronos;
use PhpSpec\ObjectBehavior;

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
        $this->getCurrentDatetime()->shouldHaveType(\DateTimeImmutable::class);
    }

    public function it_returns_system_time()
    {
        $this->getCurrentDatetime()->shouldEqualDateTime(new \DateTimeImmutable());
    }

    public function it_returns_time_in_expected_timezone()
    {
        $this->beConstructedWith(new \DateTimeImmutable('2020-05-01'));
        $this->getCurrentDatetime()->shouldEqualDateTime(new \DateTimeImmutable('2020-05-01'));
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
