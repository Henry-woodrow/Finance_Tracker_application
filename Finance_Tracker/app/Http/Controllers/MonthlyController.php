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
            'date' => 'required|date',
        ]);
    
        $amount = $request->input('amount');
        $entryDate = Carbon::parse($request->input('date'))->startOfMonth();
        $now = Carbon::now()->startOfMonth();
    
        // Calculate full months between entry date and now
        $monthsPassed = 0;
        if ($entryDate->lessThan($now)) {
            $monthsPassed = $entryDate->diffInMonths($now);
        }
    
        // Add the amount once for each full month passed
        $totalMonthly = 0;
        for ($i = 0; $i < $monthsPassed; $i++) {
            $totalMonthly += $amount;
        }
    
        Monthly::create([
            'user_id' => Auth::id(),
            'amount' => $amount,
            'date' => $request->input('date'),
            'total_monthly' => $totalMonthly,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Monthly amount added successfully!');
    }
}    