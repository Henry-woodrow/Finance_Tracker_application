<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Goal;
use App\Models\monthly;
use App\Models\weekly;
use App\Models\Gift_money;
use Illuminate\Support\Facades\Auth;
use App\Models\Bills;


class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch data
        $goals = Goal::where('user_id', $userId)->get();
        $bills = Bills::where('user_id', Auth::id())->get();
        $salary = Salary::where('user_id', $userId)->sum('posttax_amount');
        $monthlyTotal = monthly::where('user_id', $userId)->sum('total_monthly');
        $weeklyTotal = weekly::where('user_id', $userId)->sum('weekly_total');
        $giftTotal = Gift_money::where('user_id', $userId)->sum('amount');

        // Base number logic
        if ($salary > 0) {
            $number = $salary;
        } elseif ($monthlyTotal > 0) {
            $number = $monthlyTotal;
        } elseif ($weeklyTotal > 0) {
            $number = $weeklyTotal;
        } else {
            $number = 0;
        }

        // Add gift money to the total
        $number += $giftTotal;

        // Pass to view
        return view('dashboard', compact('salary', 'monthlyTotal', 'weeklyTotal', 'number', 'goals', 'bills'));
    }
}
