<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancialForecastingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('financial-planner.financial-forecasting.index', [
            "selected_navigation" => "financial-forecasting",
        ]);
    }

    public function create()
    {
        return view('financial-planner.financial-forecasting.create', [
            "selected_navigation" => "financial-forecasting",
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'revenue' => 'required|numeric',
            'cogs' => 'required|numeric',
            'operating_expenses' => 'required|numeric',
            'net_profit' => 'required|numeric',
            'market_growth' => 'required|string',
            'expected_growth' => 'required|string',
            'best_case' => 'required|string',
            'worst_case' => 'required|string',
            'most_likely' => 'required|string',
            'revenue_streams' => 'required|string',
            'cost_structure' => 'required|string',
            'sales_growth_assumption' => 'required|string',
            'expense_forecasts' => 'required|string',
        ]);

        // Save the validated data to the database or perform other actions as needed

        return redirect()->route('financial-forecasting')->with('success', 'Financial forecast created successfully.');
        return redirect()->route('financial-forecasting');
    }
}
