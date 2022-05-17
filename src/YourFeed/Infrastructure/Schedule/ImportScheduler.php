<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Schedule;

use Zenstruck\ScheduleBundle\Schedule;
use Zenstruck\ScheduleBundle\Schedule\ScheduleBuilder;

final class ImportScheduler implements ScheduleBuilder
{
    public function buildSchedule(Schedule $schedule): void
    {
//
//        $schedule->addCommand('app:send-weekly-report --detailed')
//            ->description('Send the weekly report to users.')
//            ->sundays()
//            ->at(1)
//        ;
    }
}
