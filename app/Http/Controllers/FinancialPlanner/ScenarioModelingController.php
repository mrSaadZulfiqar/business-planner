<?php

namespace App\Http\Controllers\FinancialPlanner;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ScenarioModelingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('financial-planner.scenario-modeling.index', [
            "selected_navigation" => "scenario-modeling",
        ]);
    }

    public function create()
    {
        return view('financial-planner.scenario-modeling.create', [
            "selected_navigation" => "scenario-modeling",
        ]);
    }

    public function store(Request $request)
    {
        Log::info("in the store method for open ai scenario modeling generation");
        Log::info("the request is : ");
        Log::info($request->all());

        $validatedData = $request->validate([
            'sales_growth_rate' => 'required|string',
            'expense_growth_rate' => 'required|string',
            'revenue' => 'required|numeric',
            'operating_expenses' => 'required|numeric',
            'net_profit' => 'required|numeric',
            'sales_growth' => 'required|string',
            'expense_growth' => 'required|string',
        ]);

        Log::info("after validation");

        // Generate the report using OpenAI
        $report = $this->generateReport($validatedData);

        Log::info("after generating report from open ai");
        Log::info("open ai report is : ");
        Log::info($report);

        return view('financial-planner.scenario-modeling.report', [
            'report' => $report
        ])->with('success', 'Scenario modeling created successfully.');
    }

    private function generateReport($data)
    {
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $messages = [
            [
                'role' => 'system',
                'content' => 'Generate a detailed scenario modeling report based on the provided data.',
            ],
            [
                'role' => 'user',
                'content' => "Here is the data:\n" .
                    "Scenario Parameters:\n" .
                    "Sales Growth Rate: {$data['sales_growth_rate']}\n" .
                    "Expense Growth Rate: {$data['expense_growth_rate']}\n" .
                    "Historical Financial Data (Last Year):\n" .
                    "Revenue: {$data['revenue']}\n" .
                    "Operating Expenses: {$data['operating_expenses']}\n" .
                    "Net Profit: {$data['net_profit']}\n" .
                    "Parameter Range Definition:\n" .
                    "Sales growth: {$data['sales_growth']}\n" .
                    "Expense growth: {$data['expense_growth']}\n" .
                    "Scenario Creation Logic:\n" .
                    "Linear impact on revenue and expenses based on the growth rates.\n",
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
