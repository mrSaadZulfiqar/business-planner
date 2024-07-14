<?php

namespace App\Http\Controllers\FinancialPlanner;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RiskAssessmentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('financial-planner.risk-assessment.index', [
            "selected_navigation" => "risk-assessment",
        ]);
    }

    public function create()
    {
        return view('financial-planner.risk-assessment.create', [
            "selected_navigation" => "risk-assessment",
        ]);
    }

    public function store(Request $request)
    {
        Log::info("in the store method for open ai risk assessment generation");
        Log::info("the request is : ");
        Log::info($request->all());

        $validatedData = $request->validate([
            'interest_rate_risk' => 'required|string',
            'credit_risk' => 'required|string',
            'supply_chain_risk' => 'required|string',
            'it_system_risk' => 'required|string',
            'interest_rate_risk_data' => 'required|string',
            'credit_risk_data' => 'required|string',
            'supply_chain_risk_data' => 'required|string',
            'it_system_risk_data' => 'required|string',
        ]);

        Log::info("after validation");

        // Generate the report using OpenAI
        $report = $this->generateReport($validatedData);

        Log::info("after generating report from open ai");
        Log::info("open ai report is : ");
        Log::info($report);

        return view('financial-planner.risk-assessment.report', [
            'report' => $report
        ])->with('success', 'Risk assessment created successfully.');
    }

    private function generateReport($data)
    {
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $messages = [
            [
                'role' => 'system',
                'content' => 'Generate a detailed risk assessment report based on the provided data.',
            ],
            [
                'role' => 'user',
                'content' => "Here is the data:\n" .
                    "Financial Risks:\n" .
                    "Interest Rate Risk: {$data['interest_rate_risk']}\n" .
                    "Credit Risk: {$data['credit_risk']}\n" .
                    "Operational Risks:\n" .
                    "Supply Chain Risk: {$data['supply_chain_risk']}\n" .
                    "IT System Risk: {$data['it_system_risk']}\n" .
                    "Financial Risks Data:\n" .
                    "Interest Rate Risk: {$data['interest_rate_risk_data']}\n" .
                    "Credit Risk: {$data['credit_risk_data']}\n" .
                    "Operational Risks Data:\n" .
                    "Supply Chain Risk: {$data['supply_chain_risk_data']}\n" .
                    "IT System Risk: {$data['it_system_risk_data']}\n",
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
