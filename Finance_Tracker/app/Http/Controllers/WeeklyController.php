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
        


        $entryDate = Carbon::parse($request->input('date'))->startOfMonth();
        $now = Carbon::now()->startOfMonth();
        $weeksPassed = $entryDate->diffInWeeks($now);
        $weeksPassed = max(1, $weeksPassed);
    
        $totalweekly = $request->input('amount') * $weeksPassed;

        Weekly::create([
            'user_id' => Auth::id(),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
            'total_weekly' => $totalweekly
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Weekly wage added.');
    }
    }
