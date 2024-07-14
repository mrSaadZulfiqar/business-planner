<?php

namespace App\Http\Controllers\FinancialPlanner;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DecisionSupportController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('financial-planner.decision-support.index', [
            "selected_navigation" => "decision-support",
        ]);
    }

    public function create()
    {
        return view('financial-planner.decision-support.create', [
            "selected_navigation" => "decision-support",
        ]);
    }

    public function store(Request $request)
    {
        Log::info("in the store method for open ai decision support generation");
        Log::info("the request is : ");
        Log::info($request->all());

        $validatedData = $request->validate([
            'objective' => 'required|string',
            'goal' => 'required|string',
            'historical_roi' => 'required|string',
            'budget' => 'required|numeric',
            'market_growth_rate' => 'required|string',
            'investment_risk_level' => 'required|string',
            'best_case_scenario' => 'required|string',
            'worst_case_scenario' => 'required|string',
            'most_likely_scenario' => 'required|string',
        ]);

        Log::info("after validation");

        // Generate the report using OpenAI
        $report = $this->generateReport($validatedData);

        Log::info("after generating report from open ai");
        Log::info("open ai report is : ");
        Log::info($report);

        return view('financial-planner.decision-support.report', [
            'report' => $report
        ])->with('success', 'Decision support report created successfully.');
    }

    private function generateReport($data)
    {
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $messages = [
            [
                'role' => 'system',
                'content' => 'Generate a detailed decision support report based on the provided data.',
            ],
            [
                'role' => 'user',
                'content' => "Here is the data:\n" .
                    "Objectives:\n" .
                    "Objective: {$data['objective']}\n" .
                    "Goal: {$data['goal']}\n" .
                    "Financial Data:\n" .
                    "Historical ROI on investments: {$data['historical_roi']}\n" .
                    "Budget for new investments: {$data['budget']}\n" .
                    "Key Variables:\n" .
                    "Market growth rate: {$data['market_growth_rate']}\n" .
                    "Investment risk level: {$data['investment_risk_level']}\n" .
                    "Financial Scenarios:\n" .
                    "Best-case Scenario: {$data['best_case_scenario']}\n" .
                    "Worst-case Scenario: {$data['worst_case_scenario']}\n" .
                    "Most Likely Scenario: {$data['most_likely_scenario']}\n",
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
