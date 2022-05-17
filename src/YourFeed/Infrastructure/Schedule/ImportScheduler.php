<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Schedule;

use Ferdyrurka\YourFeed\Domain\Enum\Period;
use Zenstruck\ScheduleBundle\Schedule;
use Zenstruck\ScheduleBundle\Schedule\ScheduleBuilder;

final class ImportScheduler implements ScheduleBuilder
{
    public function buildSchedule(Schedule $schedule): void
    {
        foreach (Period::cases() as $period) {
            $periodMethod = $period->value;

            $schedule
                ->addCommand('yf:import')
                ->description(
                    sprintf(
                        'Import posts from source for period: %s',
                        $period->name,
                    )
                )
                ->arguments('--period=' . $period->value)
                ->onSingleServer(120)
                ->$periodMethod()
            ;
        }
    }
}
