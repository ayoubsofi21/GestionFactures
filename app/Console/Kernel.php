<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        // Ajoute ta commande ici si tu veux la déclarer manuellement :
        // $this->commands[] = \App\Console\Commands\UpdatePaymentDelays::class;
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Planifie ta commande pour qu’elle s’exécute tous les jours à minuit
        $schedule->command('factures:update-delays')->daily();
    }
}

?>