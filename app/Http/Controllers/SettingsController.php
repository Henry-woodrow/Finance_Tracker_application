<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function reset()
    {
        $userId = Auth::id();

        // Delete all data tied to the user
        DB::table('goals')->where('user_id', $userId)->delete();
        DB::table('salary')->where('user_id', $userId)->delete();
        DB::table('monthly')->where('user_id', $userId)->delete();
        DB::table('weekly')->where('user_id', $userId)->delete();
        DB::table('gift_money')->where('user_id', $userId)->delete();
        DB::table('bills')->where('user_id', $userId)->delete();
        DB::table('balances')->where('user_id', $userId)->delete();

        return redirect()->route('dashboard')->with('success', 'Your data has been reset successfully.');
    }
}
