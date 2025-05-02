<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;
use App\Models\Salary;
use App\Models\monthly;
use App\Models\weekly;
use App\Models\Balance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class GoalController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        $salary = Salary::where('user_id', Auth::id())->sum('posttax_amount');
        $monthlyTotal = $this->calculateMonthlyTotal();
        $weeklyTotal = $this->calculateWeeklyTotal();

        $number = $this->calculateNumber($salary, $monthlyTotal, $weeklyTotal);

        return view('dashboard', compact('number', 'goals', 'salary'));
    }

    public function create()
    {
        return view('forms.Add_goal');
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        $goal = Goal::create([
            'user_id' => Auth::id(),
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'current_amount' => 0,
            'target_amount' => $request->goal_amount,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Goal created successfully!');
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::where('user_id', Auth::id())->findOrFail($id);

        if ($goal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $salary = Salary::where('user_id', Auth::id())->first();
        $monthlyTotal = $this->calculateMonthlyTotal();
        $weeklyTotal = $this->calculateWeeklyTotal();

        $request->validate([
            'current_amount' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($goal) {
                    $remainingAmount = $goal->goal_amount - $goal->current_amount;
                    if ($value > $remainingAmount) {
                        $fail("The amount exceeds the remaining goal amount of £" . number_format($remainingAmount, 2));
                    }
                },
            ],
        ]);

        if ($salary && $salary->posttax_amount >= $request->current_amount) {
            $salary->posttax_amount -= $request->current_amount;
            $salary->save();
        } elseif ($monthlyTotal >= $request->current_amount) {
            $monthlyEntry = monthly::where('user_id', Auth::id())->first();
            $monthlyEntry->amount -= $request->current_amount;
            $monthlyEntry->save();
        } elseif ($weeklyTotal >= $request->current_amount) {
            $weeklyEntry = weekly::where('user_id', Auth::id())->first();
            $weeklyEntry->amount -= $request->current_amount;
            $weeklyEntry->save();
        } else {
            return redirect()->route('dashboard')->with('error', 'Insufficient balance to add to the goal.');
        }

        // Also subtract from balance
        $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);
        $balance->number -= $request->current_amount;
        $balance->save();

        $goal->current_amount += $request->current_amount;
        $goal->save();

        return redirect()->route('dashboard')->with('success', 'Goal updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $goal = Goal::where('user_id', Auth::id())->findOrFail($id);

        $refund = $request->input('refund');
        $currentAmount = $goal->current_amount;

        $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);

        if ($refund && $currentAmount > 0) {
            $balance->number += $currentAmount;

        }
        $balance->save();

        $goal->delete();

        return redirect()->route('dashboard')->with('success', 'Goal deleted successfully!');
    }

    private function calculateMonthlyTotal()
    {
        $entries = Monthly::where('user_id', Auth::id())->get();
        $total = 0;

        foreach ($entries as $entry) {
            $entryDate = Carbon::parse($entry->date)->startOfMonth();
            $now = Carbon::now()->startOfMonth();
            $monthsPassed = $entryDate->diffInMonths($now);
            $monthsPassed = max(1, $monthsPassed);
            $total += $entry->amount * $monthsPassed;
        }

        return $total;
    }

    private function calculateWeeklyTotal()
    {
        $entries = Weekly::where('user_id', Auth::id())->get();
        $total = 0;

        foreach ($entries as $entry) {
            $entryDate = Carbon::parse($entry->date)->startOfWeek();
            $now = Carbon::now()->startOfWeek();
            $weeksPassed = $entryDate->diffInWeeks($now);
            $weeksPassed = max(1, $weeksPassed);
            $total += $entry->amount * $weeksPassed;
        }

        return $total;
    }

    private function calculateNumber($salary, $monthlyTotal, $weeklyTotal)
    {
        if ($salary > 0) {
            return $salary;
        } elseif ($monthlyTotal > 0) {
            return $monthlyTotal;
        } elseif ($weeklyTotal > 0) {
            return $weeklyTotal;
        } else {
            return 0;
        }
    }
}
