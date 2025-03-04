<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the sum of the amount column from the database
        $number = Finance::sum('amount');

        // Pass the number to the view
        return view('dashboard', compact('number'));
    }
}
