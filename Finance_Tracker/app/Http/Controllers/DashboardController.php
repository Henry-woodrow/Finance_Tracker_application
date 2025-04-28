<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\goal;
use App\Models\monthly; // Import the Monthly model
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon for date calculations

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the goals as a collection
        $goals = goal::where('user_id', Auth::id())->get();

        // Fetch the sum of the posttax_amount column from the salary table
        $salary = Salary::where('user_id', Auth::id())->sum('posttax_amount');

        // Fetch the monthly entries for the user
        $monthlyEntries = monthly::where('user_id', Auth::id())->get();

        // Calculate the total monthly amount based on months passed
        
        $monthlyTotal = Monthly::where('user_id', Auth::id())->sum('total_monthly');


        
        // Fetch the weekly amount (assuming you have a Weekly model)
        $weekly = 0; // Replace this with the actual logic to fetch weekly data if applicable

        // Determine the value of $number based on salary, monthly, and weekly
        if ($salary > 0) {
            $number = $salary;
        } elseif ($monthlyTotal > 0) {
            $number = $monthlyTotal; // Indicate that monthly is being used
        } elseif ($weekly > 0) {
            $number = 3; // Indicate that weekly is being used
        } else {
            $number = 0; // No salary, monthly, or weekly amount
        }

        // Pass the data to the view
        return view('dashboard', compact('salary', 'monthlyTotal', 'weekly', 'number', 'goals'));
    }
}