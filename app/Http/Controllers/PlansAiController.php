<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlansAiController extends BaseController
{
    public function ai(Request $request)
    {

        $content='';
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $action = $request->action;

        $messages = [];

        if($action == 'ex_summary'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the executive summary of my business.',
                ],
            ];
        }
        if($action == 'com_description'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the company description of my business.',
                ],
            ];
        }
        if($action == 'market_analysis'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the market analysis of my business.',
                ],
            ];
        }
        if($action == 'organization'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Write management structure of my business.',
                ],
            ];
        }
        if($action == 'service_product'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the service of products of my business offer.',
                ],
            ];
        }
        if($action == 'marketing_sale'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the market and sale strategy of my business.',
                ],
            ];
        }

        if($action == 'budget'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate a budget for my company for next 2 years.',
                ],
            ];
        }

        if($action == 'investment'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the investment or funding request of my business for next 3 to 5 years.',
                ],
            ];
        }

        if($action == 'financial_projections'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate financial projections Supply information like balance sheets of my business.',
                ],
            ];
        }

        if($action == 'appendix'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Write about the apendix like resumes and permits for my business.',
                ],
            ];
        }

        $response = $client->chat()->create([
            'model'=>'gpt-3.5-turbo',
            'messages'=> $messages,
        ]);

        foreach ($response->choices as $result) {
            $content .= $result->message->content;
        }

        $content = Str::markdown($content);

        return response()->json([
            'message' => $content,
            'status' => 'success',

        ], 200);


    }
}
