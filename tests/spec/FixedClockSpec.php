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

    public function it_returns_time_in_utc_when_no_timezone_is_given()
    {
        $this->beConstructedWith();
        $dt = $this->getCurrentDatetime();
        $this->getCurrentDatetime()->shouldHaveType(\DateTimeImmutable::class);
        $this->getCurrentDatetime()->getTimezone()->getName();
    }

    public function it_returns_the_same_time_on_multiple_calls()
    {
        $this->beConstructedWith(new \DateTimeImmutable('2022-01-01T12:00:00+00:00'));
        $first = $this->getCurrentDatetime();
        $second = $this->getCurrentDatetime();
        if ($first != $second) {
            throw new \Exception('FixedClock should always return the same time');
        }
    }

    public function it_can_be_constructed_with_a_specific_time()
    {
        $dt = new \DateTimeImmutable('2023-05-27T15:00:00+00:00');
        $this->beConstructedWith($dt);
        $this->getCurrentDatetime()->shouldEqualDateTime($dt);
    }

    public function getMatchers(): array
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
