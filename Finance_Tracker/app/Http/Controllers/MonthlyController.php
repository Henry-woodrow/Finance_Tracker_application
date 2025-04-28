<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\monthly;
use Carbon\Carbon;

class MonthlyController extends Controller
{
    /**
     * Store a newly created monthly entry in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:0',
        'date' => 'required|date', // Make sure you require a date too
    ]);

    $entryDate = Carbon::parse($request->input('date'))->startOfMonth();
    $now = Carbon::now()->startOfMonth();
    $monthsPassed = $entryDate->diffInMonths($now);
    $monthsPassed = max(1, $monthsPassed);

    $totalMonthly = $request->input('amount') * $monthsPassed;

    Monthly::create([
        'user_id' => Auth::id(),
        'amount' => $request->input('amount'),
        'date' => $request->input('date'),
        'total_monthly' => $totalMonthly,
    ]);

    return redirect()->route('dashboard')->with('success', 'Monthly amount added successfully!');
}
}