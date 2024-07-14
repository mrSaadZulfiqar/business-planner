<?php

namespace App\Http\Controllers\FinancialPlanner;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RiskAnalysisController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('financial-planner.risk-analysis.index', [
            "selected_navigation" => "risk-analysis",
        ]);
    }

    public function create()
    {
        return view('financial-planner.risk-analysis.create', [
            "selected_navigation" => "risk-analysis",
        ]);
    }

    public function store(Request $request)
    {
        Log::info("in the store method for open ai risk analysis generation");
        Log::info("the request is : ");
        Log::info($request->all());

        $validatedData = $request->validate([
            'credit_risk' => 'required|string',
            'market_risk' => 'required|string',
            'credit_risk_data_customer_a' => 'required|string',
            'credit_risk_data_customer_b' => 'required|string',
            'credit_risk_data_customer_c' => 'required|string',
            'market_risk_avg_fluctuation' => 'required|string',
            'market_risk_max_fluctuation' => 'required|string',
            'market_risk_min_fluctuation' => 'required|string',
        ]);

        Log::info("after validation");

        // Generate the report using OpenAI
        $report = $this->generateReport($validatedData);

        Log::info("after generating report from open ai");
        Log::info("open ai report is : ");
        Log::info($report);

        return view('financial-planner.risk-analysis.report', [
            'report' => $report
        ])->with('success', 'Risk analysis created successfully.');
    }

    private function generateReport($data)
    {
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $messages = [
            [
                'role' => 'system',
                'content' => 'Generate a detailed risk analysis report based on the provided data.',
            ],
            [
                'role' => 'user',
                'content' => "Here is the data:\n" .
                    "Risk Factors:\n" .
                    "Credit Risk: {$data['credit_risk']}\n" .
                    "Market Risk: {$data['market_risk']}\n" .
                    "Data Collection:\n" .
                    "For credit risk: we have a dataset of customer loan payment histories.\n" .
                    "For market risk: we have historical stock price data for the company.\n" .
                    "Credit Risk Data:\n" .
                    "Customer A: {$data['credit_risk_data_customer_a']}\n" .
                    "Customer B: {$data['credit_risk_data_customer_b']}\n" .
                    "Customer C: {$data['credit_risk_data_customer_c']}\n" .
                    "Market Risk Data (Stock Price Fluctuations Over the Last Year):\n" .
                    "Average fluctuation: {$data['market_risk_avg_fluctuation']}\n" .
                    "Maximum fluctuation: {$data['market_risk_max_fluctuation']}\n" .
                    "Minimum fluctuation: {$data['market_risk_min_fluctuation']}\n",
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
