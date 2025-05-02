<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // your scheduled commands go here
        $schedule->command('monthly:refresh')->monthly();
        $schedule->command('weekly:refresh')->weekly(); // or daily() or monthlyOn(1, '02:00')
        $schedule->command('bills:process')->daily();
    }

    

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
