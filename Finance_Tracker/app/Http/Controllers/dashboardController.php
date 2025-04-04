<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;
use App\Models\goal;
class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the sum of the amount column from the database
        // this means i can get the post tax amount displayed on the dashboard
    // Fetch the goals as a collection
    $goals = Goal::where('user_id', Auth::id())->get();

    // Fetch the sum of the posttax_amount column from the salary table
    $salary = Salary::where('user_id', Auth::id())->sum('posttax_amount');

    // Determine the value of $number based on the salary
    $number = $salary == 0 ? 0 : 1;

    // Pass the data to the view
    return view('dashboard', compact('salary', 'number', 'goals'));
    }
}
