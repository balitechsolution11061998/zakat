<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // Initial values for nisab and other required variables
        $nisabPerYear = 82312725;
        $nisabPerMonth = $nisabPerYear / 12;

        // Set initial values to zero
        $totalMonthlyIncome = 0;
        $zakat = 0;
        $monthlyIncome = 0;
        $otherMonthlyIncome = 0;

        return view('home', compact('nisabPerYear', 'nisabPerMonth', 'totalMonthlyIncome', 'zakat', 'monthlyIncome', 'otherMonthlyIncome'));
    }

    public function calculateZakat(Request $request)
    {
        // Get input values
        $monthlyIncome = $request->input('monthly_income');
        $otherMonthlyIncome = $request->input('other_monthly_income');

        // Calculate total income per month
        $totalMonthlyIncome = $monthlyIncome + $otherMonthlyIncome;
        $nisabPerYear = 82312725;
        $nisabPerMonth = $nisabPerYear / 12;

        // Check if income is above nisab
        if ($totalMonthlyIncome >= $nisabPerMonth) {
            $zakat = $totalMonthlyIncome * 0.025; // Zakat is 2.5%
        } else {
            $zakat = 0;
        }

        return view('home', compact('nisabPerYear', 'nisabPerMonth', 'totalMonthlyIncome', 'zakat', 'monthlyIncome', 'otherMonthlyIncome'));
    }
}
