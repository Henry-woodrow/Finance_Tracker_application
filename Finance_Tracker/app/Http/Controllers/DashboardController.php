<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Goal;
use App\Models\monthly; // Import the Monthly model
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon for date calculations
use App\Http\Controllers\Controller;
use App\Models\weekly; // Import the Weekly model

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the goals as a collection
        $goals = Goal::where('user_id', Auth::id())->get();

        // Fetch the sum of the posttax_amount column from the salary table
        $salary = Salary::where('user_id', Auth::id())->sum('posttax_amount');

        // Fetch the monthly entries for the user
        $monthlyEntries = monthly::where('user_id', Auth::id())->get();

        // Calculate the total monthly amount based on months passed
        
        $monthlyTotal = monthly::where('user_id', Auth::id())->sum('total_monthly');

        // weekly entries for the user
        $weeklyTotal = Weekly::where('user_id', Auth::id())->sum('weekly_total');
        
        // Determine the value of $number based on salary, monthly, and weekly
        if ($salary > 0) {
            $number = $salary;
        } elseif ($monthlyTotal > 0) {
            $number = $monthlyTotal; // Indicate that monthly is being used
        } elseif ($weeklyTotal > 0) {
            $number = $weeklyTotal; // Indicate that weekly is being used
        } else {
            $number = 0; // No salary, monthly, or weekly amount
        }

        // Pass the data to the view
        return view('dashboard', compact('salary', 'monthlyTotal', 'weeklyTotal', 'number', 'goals'));
    }
}