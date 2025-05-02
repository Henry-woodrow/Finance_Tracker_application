<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'salary' => 'required|numeric|min:10000', // Validate the salary input
        ]);

        // Get the salary input
        $pretaxSalary = $request->input('salary');

        // Calculate the post-tax salary using the UK tax system
        $posttaxSalary = $this->calculateUKTax($pretaxSalary);

        // Store the salary in the database
        Salary::create([
            'user_id' => Auth::id(), // Store the authenticated user's ID
            'pretax_amount' => $pretaxSalary, // Save the pre-tax salary
            'posttax_amount' => $posttaxSalary, // Save the post-tax salary
        ]);

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Salary added successfully!');
    }

    
    /**
     * Calculate the post-tax salary based on the UK tax system.
     */
    private function calculateUKTax($income)
    {
        // Define tax bands and rates
        $personalAllowance = 12570; // Personal allowance
        $basicRateLimit = 50270; // Upper limit for basic rate
        $higherRateLimit = 125140; // Upper limit for higher rate
        $additionalRateThreshold = 125140; // Threshold for additional rate

        $basicRate = 0.20; // 20%
        $higherRate = 0.40; // 40%
        $additionalRate = 0.45; // 45%

        // Adjust personal allowance for high earners
        if ($income > 100000) {
            $personalAllowance -= ($income - 100000) / 2;
            if ($personalAllowance < 0) {
                $personalAllowance = 0;
            }
        }

        // Calculate taxable income
        $taxableIncome = max(0, $income - $personalAllowance);

        // Calculate tax
        $tax = 0;

        // Basic rate tax
        if ($taxableIncome > 0) {
            $basicTaxable = min($taxableIncome, $basicRateLimit - $personalAllowance);
            $tax += $basicTaxable * $basicRate;
        }

        // Higher rate tax
        if ($taxableIncome > $basicRateLimit) {
            $higherTaxable = min($taxableIncome - $basicRateLimit, $higherRateLimit - $basicRateLimit);
            $tax += $higherTaxable * $higherRate;
        }

        // Additional rate tax
        if ($taxableIncome > $higherRateLimit) {
            $additionalTaxable = $taxableIncome - $higherRateLimit;
            $tax += $additionalTaxable * $additionalRate;
        }

        // Calculate post-tax income
        return round($income - $tax, 2);
    }

}
