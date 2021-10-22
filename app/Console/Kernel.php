<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CarregaComicsSemana;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CarregaComicsSemana::class,
    ];
    
    protected function schedule(Schedule $schedule) {
        // $schedule->command('inspire')->hourly();
        $schedule->command("busca:semanacomics")->weeklyOn(1, '8:00');
    }

    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}
