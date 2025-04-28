<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Monthly;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RefreshMonthlyTotals extends Command
{
    protected $signature = 'monthly:refresh';

    protected $description = 'Refresh total_monthly for all users';

    public function handle()
    {
        $this->info('Refreshing monthly totals...');

        $entries = Monthly::all();

        foreach ($entries as $entry) {
            $entryDate = Carbon::parse($entry->date)->startOfMonth();
            $now = Carbon::now()->startOfMonth();
            $monthsPassed = $entryDate->diffInMonths($now);
            $monthsPassed = max(1, $monthsPassed);

            $newTotal = $entry->amount * $monthsPassed;

            $entry->update([
                'total_monthly' => $newTotal,
            ]);
        }

        $this->info('Monthly totals refreshed successfully.');
    }
}
