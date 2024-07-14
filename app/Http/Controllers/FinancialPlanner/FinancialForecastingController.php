<?php

namespace App\Http\Controllers\FinancialPlanner;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        Log::info("in the store method for open ai report generation");
        Log::info("the request is : ");
        Log::info($request->all());

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

        Log::info("after validation");

        // Generate the report using OpenAI
        $report = $this->generateReport($validatedData);

        Log::info("after generating report from open ai");
        Log::info("open ai report is : ");
        Log::info($report);

        return view('financial-planner.financial-forecasting.report', [
            'report' => $report
        ])->with('success', 'Financial forecast created successfully.');
    }

    private function generateReport($data)
    {
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $messages = [
            [
                'role' => 'system',
                'content' => 'Generate a detailed financial forecasting report based on the provided data.',
            ],
            [
                'role' => 'user',
                'content' => "Here is the data:\n" .
                    "Historical Financial Data (Past Year):\n" .
                    "Revenue: {$data['revenue']}\n" .
                    "Cost of Goods Sold (COGS): {$data['cogs']}\n" .
                    "Operating Expenses: {$data['operating_expenses']}\n" .
                    "Net Profit: {$data['net_profit']}\n" .
                    "Market Analysis:\n" .
                    "Market growth: {$data['market_growth']}\n" .
                    "Company's expected growth: {$data['expected_growth']}\n" .
                    "Scenario-Specific Variables:\n" .
                    "Best-case: {$data['best_case']}\n" .
                    "Worst-case: {$data['worst_case']}\n" .
                    "Most likely: {$data['most_likely']}\n" .
                    "Business Model Description:\n" .
                    "Revenue Streams: {$data['revenue_streams']}\n" .
                    "Cost Structure: {$data['cost_structure']}\n" .
                    "Growth Projections and Assumptions:\n" .
                    "Sales growth assumption: {$data['sales_growth_assumption']}\n" .
                    "Expense Forecasts: {$data['expense_forecasts']}\n",
            ],
        ];

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ]);

        $content = '';
        foreach ($response->choices as $result) {
            $content .= $result->message->content;
        }

        return Str::markdown($content);
    }
}
