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

    public function it_returns_time_in_utc_when_no_timezone_is_given()
    {
        $this->beConstructedWith();
        $dt = $this->getCurrentDatetime();
        $this->getCurrentDatetime()->shouldHaveType(\DateTimeImmutable::class);
        $this->getCurrentDatetime()->getTimezone()->getName();
    }

    public function it_returns_different_times_on_subsequent_calls()
    {
        $first = $this->getCurrentDatetime();
        sleep(1);
        $second = $this->getCurrentDatetime();
        if ($first == $second) {
            throw new \Exception('SystemClock should return different times on subsequent calls');
        }
    }

    public function it_can_be_constructed_with_a_timezone()
    {
        $tz = new \DateTimeZone('Asia/Tokyo');
        $this->beConstructedWith($tz);
        $dt = $this->getCurrentDatetime();
        $dt->getTimezone()->getName();
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
