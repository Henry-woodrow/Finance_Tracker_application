<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\weekly;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RefreshWeeklyTotals extends Command
{
    protected $signature = 'weekly:refresh';

    protected $description = 'Refresh total_weekly for all users';

    public function handle()
    {
        $this->info('Refreshing monthly totals...');

        $entries = weekly::all();

        foreach ($entries as $entry) {
            $entryDate = Carbon::parse($entry->date)->startOfMonth();
            $now = Carbon::now()->startOfMonth();
            $weeksPassed = $entryDate->diffInWeeks($now);
            $monthsPassed = max(1, $weeksPassed);

            $newTotal = $entry->amount * $monthsPassed;

            $entry->update([
                'total_monthly' => $newTotal,
            ]);
        }

        $this->info('weeks totals refreshed successfully.');
    }
}


