<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StartupCanvasAiController extends BaseController
{
    public function ai(Request $request)
    {

        $content='';
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $action = $request->action;

        $messages = [];

        if($action == 'problems'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Write about the problems of startup canvas of my business',
                ],
            ];
        }
        if($action == 'solutions'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Write the solutions of startup canvas of my business',
                ],
            ];
        }
        if($action == 'value'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the value proposition of startup canvas of my business',
                ],
            ];
        }
        if($action == 'advantage'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Write the advantage of startup canvas of my business',
                ],
            ];
        }
        if($action == 'metrics'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the matrics of startup canvas of my business',
                ],
            ];
        }
        if($action == 'cost_structure'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the cost structure of startup canvas of my business',
                ],
            ];
        }

        if($action == 'customer_segments'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the customer segments of startup canvas of my business',
                ],
            ];
        }

        if($action == 'channels'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Write about the channels of startup canvas of my business.',
                ],
            ];
        }

        if($action == 'value_propositions'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the value proposition of startup canvas of my business',
                ],
            ];
        }

        if($action == 'revenue_stream'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the revenue stream of startup canvas of my business',
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
