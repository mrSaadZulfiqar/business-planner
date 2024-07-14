<?php

namespace App\Http\Controllers\FinancialPlanner;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SensitivityAnalysisController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('financial-planner.sensitivity-analysis.index', [
            "selected_navigation" => "sensitivity-analysis",
        ]);
    }

    public function create()
    {
        return view('financial-planner.sensitivity-analysis.create', [
            "selected_navigation" => "sensitivity-analysis",
        ]);
    }

    public function store(Request $request)
    {
        Log::info("in the store method for open ai sensitivity analysis generation");
        Log::info("the request is : ");
        Log::info($request->all());

        $validatedData = $request->validate([
            'primary_financial_outcome' => 'required|string',
            'key_variables' => 'required|string',
            'sales_volume_change' => 'required|string',
            'cogs_change' => 'required|string',
            'current_sales_volume' => 'required|numeric',
            'current_cogs' => 'required|numeric',
            'selling_price_per_unit' => 'required|numeric',
            'current_net_profit' => 'required|numeric',
        ]);

        Log::info("after validation");

        // Generate the report using OpenAI
        $report = $this->generateReport($validatedData);

        Log::info("after generating report from open ai");
        Log::info("open ai report is : ");
        Log::info($report);

        return view('financial-planner.sensitivity-analysis.report', [
            'report' => $report
        ])->with('success', 'Sensitivity analysis created successfully.');
    }

    private function generateReport($data)
    {
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $messages = [
            [
                'role' => 'system',
                'content' => 'Generate a detailed sensitivity analysis report based on the provided data.',
            ],
            [
                'role' => 'user',
                'content' => "Here is the data:\n" .
                    "Financial Outcomes:\n" .
                    "Primary financial outcome to analyze: {$data['primary_financial_outcome']}\n" .
                    "Key Variables:\n" .
                    "Key Variables: {$data['key_variables']}\n" .
                    "Range of Variable Changes:\n" .
                    "Sales Volume: {$data['sales_volume_change']}\n" .
                    "COGS: {$data['cogs_change']}\n" .
                    "Current Variable Values:\n" .
                    "Current Sales Volume: {$data['current_sales_volume']}\n" .
                    "Current COGS: {$data['current_cogs']}\n" .
                    "Selling Price per Unit: {$data['selling_price_per_unit']}\n" .
                    "Current Net Profit: {$data['current_net_profit']}\n",
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
