<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bills;
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
    
        return redirect()->route('dashboard')->with('success', 'Bill added successfully!');
    }
    
    public function destroy($id)
    {
        $bill = Bills::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $bill->delete();
    
        return redirect()->route('dashboard')->with('success', 'Bill deleted.');
    }
}
