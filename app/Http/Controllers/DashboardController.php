<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Goal;
use App\Models\monthly;
use App\Models\weekly;
use App\Models\Gift_money;
use App\Models\Bills;
use App\Models\Balance;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch data
        $goals = Goal::where('user_id', $userId)->get();
        $bills = Bills::where('user_id', $userId)->get();
        $salary = Salary::where('user_id', $userId)->sum('posttax_amount');
        $monthlyTotal = monthly::where('user_id', $userId)->sum('total_monthly');
        $weeklyTotal = weekly::where('user_id', $userId)->sum('weekly_total');
        $giftTotal = Gift_money::where('user_id', $userId)->sum('amount');

        // Determine balance source
        $base = 0;
        if ($salary > 0) {
            $base = $salary;
        } elseif ($monthlyTotal > 0) {
            $base = $monthlyTotal;
        } elseif ($weeklyTotal > 0) {
            $base = $weeklyTotal;
        }

        // Add gifts only (bills and goals handled manually via refund logic)
        $balance = Balance::firstOrCreate(['user_id' => $userId]);
        

        // Get final balance value
        $number = $balance->number;

        // Pass to view
        return view('dashboard', compact('salary', 'monthlyTotal', 'weeklyTotal', 'number', 'goals', 'bills'));
    }
}