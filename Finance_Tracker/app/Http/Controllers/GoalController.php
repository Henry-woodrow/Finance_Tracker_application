<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;
use App\Models\Salary;
use App\Models\monthly;
use App\Models\weekly;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class GoalController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the goals.
     */
    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        $salary = Salary::where('user_id', Auth::id())->sum('posttax_amount');
        $monthlyTotal = $this->calculateMonthlyTotal();
        $weeklyTotal = $this->calculateWeeklyTotal();

        $number = $this->calculateNumber($salary, $monthlyTotal, $weeklyTotal);

        return redirect()->route('dashboard')->with('success', 'Goal created successfully!');
    }

    /**
     * Show the form for creating a new goal.
     */
    public function create()
    {
        return view('forms.Add_goal');
    }

    /**
     * Store a newly created goal in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'current_amount' => 0,
            'target_amount' => $request->goal_amount,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('goal.index')->with('success', 'Goal created successfully!');
    }

    /**
     * Update the specified goal in storage.
     */
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

        // Deduct from appropriate balance
        if ($salary && $salary->posttax_amount >= $request->current_amount) {
            $salary->posttax_amount -= $request->current_amount;
            $salary->save();
        } elseif ($monthlyTotal >= $request->current_amount) {
            $monthlyEntry = Monthly::where('user_id', Auth::id())->first();
            $monthlyEntry->amount -= $request->current_amount;
            $monthlyEntry->save();
        } elseif ($weeklyTotal >= $request->current_amount) {
            $weeklyEntry = Weekly::where('user_id', Auth::id())->first();
            $weeklyEntry->amount -= $request->current_amount;
            $weeklyEntry->save();
        } else {
            return redirect()->route('dashboard')->with('error', 'Insufficient balance to add to the goal.');
        }

        // Update goal amount
        $goal->current_amount += $request->current_amount;
        $goal->save();

        return redirect()->route('dashboard')->with('success', 'Goal updated successfully!');
    }

    /**
     * Remove the specified goal from storage.
     */
    public function destroy($id)
    {
        $goal = Goal::where('user_id', Auth::id())->findOrFail($id);
        $goal->delete();
    
        return redirect()->route('dashboard')->with('success', 'Goal deleted successfully!');
    }
    
    /**
     * Helper function to calculate monthly total.
     */
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

    /**
     * Helper function to calculate weekly total.
     */
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

    /**
     * Helper function to determine which value to use.
     */
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
