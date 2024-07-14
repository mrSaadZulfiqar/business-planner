<?php

namespace App\Http\Controllers\FinancialPlanner;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BenchmarkingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('financial-planner.benchmarking.index', [
            "selected_navigation" => "benchmarking",
        ]);
    }

    public function create()
    {
        return view('financial-planner.benchmarking.create', [
            "selected_navigation" => "benchmarking",
        ]);
    }

    public function store(Request $request)
    {
        Log::info("in the store method for open ai benchmarking generation");
        Log::info("the request is : ");
        Log::info($request->all());

        $validatedData = $request->validate([
            'metrics' => 'required|string',
            'revenue' => 'required|numeric',
            'net_profit' => 'required|numeric',
            'operating_expenses' => 'required|numeric',
            'revenue_growth_rate' => 'required|string',
            'profit_margin' => 'required|string',
            'operating_expenses_ratio' => 'required|string',
            'avg_revenue_growth_rate' => 'required|numeric',
            'avg_profit_margin' => 'required|numeric',
            'avg_operating_expenses_ratio' => 'required|numeric',
            'peer_avg_revenue_growth_rate' => 'required|numeric',
            'peer_avg_profit_margin' => 'required|numeric',
            'peer_avg_operating_expenses_ratio' => 'required|numeric',
        ]);

        Log::info("after validation");

        // Generate the report using OpenAI
        $report = $this->generateReport($validatedData);

        Log::info("after generating report from open ai");
        Log::info("open ai report is : ");
        Log::info($report);

        return view('financial-planner.benchmarking.report', [
            'report' => $report
        ])->with('success', 'Benchmarking report created successfully.');
    }

    private function generateReport($data)
    {
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $messages = [
            [
                'role' => 'system',
                'content' => 'Generate a detailed benchmarking report based on the provided data.',
            ],
            [
                'role' => 'user',
                'content' => "Here is the data:\n" .
                    "Benchmarking Metrics:\n" .
                    "Metrics: {$data['metrics']}\n" .
                    "Gather Financial Data:\n" .
                    "Revenue: {$data['revenue']}\n" .
                    "Net Profit: {$data['net_profit']}\n" .
                    "Operating Expenses: {$data['operating_expenses']}\n" .
                    "Revenue Growth Rate: {$data['revenue_growth_rate']}\n" .
                    "Profit Margin: {$data['profit_margin']}\n" .
                    "Operating Expenses Ratio: {$data['operating_expenses_ratio']}\n" .
                    "Industry Benchmarks:\n" .
                    "Average Revenue Growth Rate: {$data['avg_revenue_growth_rate']}\n" .
                    "Average Profit Margin: {$data['avg_profit_margin']}\n" .
                    "Average Operating Expenses Ratio: {$data['avg_operating_expenses_ratio']}\n" .
                    "Peer Group:\n" .
                    "Average Revenue Growth Rate: {$data['peer_avg_revenue_growth_rate']}\n" .
                    "Average Profit Margin: {$data['peer_avg_profit_margin']}\n" .
                    "Average Operating Expenses Ratio: {$data['peer_avg_operating_expenses_ratio']}\n",
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
