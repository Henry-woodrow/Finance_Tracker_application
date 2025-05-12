<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\weekly;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WeeklyController extends Controller
{
    public function create()
    {
        return view('weekly_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);
        
        // Get the user input
        $amount = $request->input('amount');
        $dateInput = Carbon::parse($request->input('date'));
        $now = Carbon::now();
        
        $weeksPassed = 1;
        if ($dateInput->lessThan($now)) {
            $weeksPassed = $dateInput->diffInWeeks($now);
        }
        $totalweekly = 0;
        for ($i = 0; $i < $weeksPassed; $i++) {
            $totalweekly = $totalweekly + $amount;
        }
        Weekly::create([
            'user_id' => Auth::id(),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
            'weekly_total' => $totalweekly
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Weekly wage added.');
    }
    }
