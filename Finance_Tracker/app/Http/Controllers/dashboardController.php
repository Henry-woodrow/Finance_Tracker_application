<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the sum of the amount column from the database
        // thsi means i can get the post tax amount displayed on the dashboard
        $number = Salary::where('user_id', Auth::id())->sum('posttax_amount');

        // Pass the number to the view
        return view('dashboard', compact('number'));
    }
}
