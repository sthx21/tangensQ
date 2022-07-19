<?php

namespace App\Console;

use App\Console\Commands\DatabaseBackUp;
use App\Console\Commands\GetAttachments;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Webklex\IMAP\Commands\ImapIdleCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       ImapIdleCommand::class,
        DatabaseBackUp::class,
        GetAttachments::class
        ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune')->daily();
	    $schedule->command('backup:run')->daily()->at('05:00');
        $schedule->command('database:backup')->daily()->at('00:30');
        $schedule->command('database:backup')->weekly()->at('01:30');
        $schedule->command('database:backup')->monthly()->at('03:00');
        $schedule->command('attachments:get')->everyMinute();

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
