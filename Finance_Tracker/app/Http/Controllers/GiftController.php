<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gift_money;

class GiftController extends Controller
{
    /**
     * Show the one-off payment form.
     */
    public function create()
    {
        return view('forms.one_off_payments');
    }

    /**
     * Store a new one-off payment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gift_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'gift_description' => 'nullable|string|max:500',
        ]);

        Gift_money::create([
            'user_id' => Auth::id(),
            'gift_name' => $request->input('gift_name'),
            'amount' => $request->input('amount'),
            'gift_description' => $request->input('gift_description'),
        ]);


        $balance = \App\Models\Balance::firstOrCreate(['user_id' => Auth::id()]);
        $balance->number += $request->input('amount');
        $balance->save();
        
        return redirect()->route('dashboard')->with('success', 'One-off payment added!');
    }
}
