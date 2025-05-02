<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bills;
use App\Models\Balance;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bill_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);
    
        Bills::create([
            'user_id' => Auth::id(),
            'bill_name' => $request->input('bill_name'),
            'amount' => $request->input('amount'),
            'due_date' => $request->input('due_date'),
        ]);


        // Subtract immediately if due_date is today or in past
        if ($request->input('due_date') && \Carbon\Carbon::parse($request->input('due_date'))->lte(now())) {
        $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);
        $balance->number -= $request->input('amount');
        $balance->save();
}
        
        $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);
        $balance->number -= $request->input('amount');
        $balance->save();

        return redirect()->route('dashboard')->with('success', 'Bill added successfully!');
    }
    
    public function destroy(Request $request, $id)
    {
        $bill = Bills::where('user_id', Auth::id())->findOrFail($id);
    
        $refund = $request->input('refund');
    
        if ($refund && $bill->amount > 0) {
            $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);
            $balance->number += $bill->amount;
            $balance->save();
        }
    
        $bill->delete();
    
        return redirect()->route('dashboard')->with('success', 'Bill deleted successfully!');
    }
}