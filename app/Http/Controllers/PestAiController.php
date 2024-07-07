<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PestAiController extends BaseController
{
    
    public function ai(Request $request)
    {

        $content='';
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $action = $request->action;

        $messages = [];

        if($action == 'political'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate political factors of my business',
                ],
            ];
        }
        if($action == 'economic'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate economic factors of my business',
                ],
            ];
        }
        if($action == 'social'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate social factors include the cultural aspects and health consciousness, population growth rate, age distribution, career attitudes and emphasis on safety of my business',
                ],
            ];
        }
        if($action == 'technological'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate technological factors include technological aspects like R&D activity, automation, technology incentives and the rate of technological change of my business',
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
