<?php

namespace App\Console\Commands; // <<< YOU MISSED THIS!

use Illuminate\Console\Command;
use App\Models\Facture;
use Carbon\Carbon;

class UpdatePaymentDelays extends Command
{
    protected $signature = 'factures:update-delays';
    protected $description = 'Update payment_delay for each facture';

    public function handle()
    {
        $factures = Facture::all();

        foreach ($factures as $facture) {
            if ($facture->date_reception_facture) {
                $delay = Carbon::parse($facture->date_reception_facture)->diffInDays(Carbon::now());
                $facture->payment_delay = $delay;
                $facture->save();
            }
        }

        $this->info('Payment delays updated successfully.');
    }
}
?>
