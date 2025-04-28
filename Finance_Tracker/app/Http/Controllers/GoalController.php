<?php

namespace App\Http\Controllers;

use App\Models\goal;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Salary;

class GoalController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the goals.
     */
    public function index()
    {
        $goals = goal::where('user_id', Auth::id())->get();
        $salary = Salary::where('user_id', Auth::id())->sum('posttax_amount');
        // Ensure the Salary model exists and is correctly defined in App\Models
        $number = 1;
        return view('dashboard', compact('number' , 'goals', 'salary'));

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

        goal::create([
            'user_id' => Auth::id(),
            'id' => $request->id,
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'current_amount' => 0,
            'target_amount' => $request->goal_amount,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('goal.index')->with('success', 'Goal created successfully!');
    }

    /**
     * Display the specified goal.
     */
    public function show(goal $goal)
    {
        $this->authorize('view', $goal);

        return view('goal.show', compact('goal'));
    }

    /**
     * Show the form for editing the specified goal.
     */
    public function edit(goal $goal)
    {
        $this->authorize('update', $goal);

        return view('goal.edit', compact('goal'));
    }

    /**
     * Update the specified goal in storage.
     */
    public function update(Request $request, goal $goal)
    {
        $salary = Salary::where('user_id', Auth::id())->first();
       // Validate the input
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



        // subtract the current amount from the salary


    // Check if the salary exists and if the user has enough post-tax balance
    if (($salary && $salary->posttax_amount >= $request->current_amount) && ($goal->goal_amount >= $goal->current_amount)){
        // Deduct the entered amount from the salary's post-tax amount
        $salary = Salary::where('user_id', Auth::id())->first();
        $salary->posttax_amount -= $request->current_amount;
        $salary->save();
        // Add the entered amount to the goal's current amount
        $goal->current_amount = $goal->current_amount + $request->current_amount;
        $goal->save();

        $goals = goal::where('user_id', Auth::id())->get();
        $salary = Salary::where('user_id', Auth::id())->sum('posttax_amount');
        // Ensure the Salary model exists and is correctly defined in App\Models
        $number = 1;
        return view('dashboard', compact('number' , 'goals', 'salary'));

    }

    // If the user doesn't have enough balance, redirect back with an error message
    return redirect()->route('dashboard')->with('error', 'Insufficient balance to add to the goal.');



    }

    /**
     * Remove the specified goal from storage.
     */
    public function destroy(goal $goal)
    {
        $this->authorize('delete', $goal);

        $goal->delete();

        return redirect()->route('dashboard')->with('success', 'Goal deleted successfully!');
    }
}
