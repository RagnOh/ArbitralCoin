<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\DataLayer;
use App\Models\Pair;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $secondi_update=20;
            $x=60/$secondi_update;
            do{
            $dl = new DataLayer();
            $dl->deleteUserNotPaying();
           $dl->resetDone();
           sleep(4);
           Pair::truncate();
           $dl->updateTable();
           
           $x=$x-1;
           sleep(11);
            }while($x>0);
            
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
