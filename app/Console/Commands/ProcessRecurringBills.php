<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bills;
use App\Models\Balance;
use Carbon\Carbon;

class ProcessRecurringBills extends Command
{


    protected $signature = 'bills:process';

    protected $description = 'Process recurring bills and update balances accordingly.';
    public function handle()
    {
        $today = Carbon::today();
    
        $bills = Bills::where('is_recurring', true)->get();
    
        foreach ($bills as $bill) {
            $due = Carbon::parse($bill->due_date);
    
            if (
                ($bill->recurring_type === 'weekly' && $due->diffInWeeks($today) >= 1) ||
                ($bill->recurring_type === 'monthly' && $due->diffInMonths($today) >= 1)
            ) {
                // Deduct from balance
                $balance = Balance::firstOrCreate(['user_id' => $bill->user_id]);
                $balance->number -= $bill->amount;
                $balance->save();
    
                // Update due date to next period
                $bill->due_date = $bill->recurring_type === 'weekly'
                    ? $due->addWeek()
                    : $due->addMonth();
                $bill->save();
            }
        }
    
        $this->info('Recurring bills processed.');
    }
}
