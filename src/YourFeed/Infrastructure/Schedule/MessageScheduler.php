<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Schedule;

use Zenstruck\ScheduleBundle\Schedule;
use Zenstruck\ScheduleBundle\Schedule\ScheduleBuilder;

class MessageScheduler implements ScheduleBuilder
{
    public function buildSchedule(Schedule $schedule): void
    {
        $schedule
            ->addCommand('messenger:consume')
            ->description('Run consumer for messenger')
            ->arguments('--time-limit=300', '--memory-limit=128M', '--limit=5')
            ->everyMinute()
            ->onSingleServer(300)
        ;
    }

}
