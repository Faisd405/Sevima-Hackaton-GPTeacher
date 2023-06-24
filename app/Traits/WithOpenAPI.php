<?php

namespace App\Traits;

use OpenAI;

trait WithOpenAPI
{
    public function generatePromptOpenAPI($prompt)
    {
        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $response = $client->completions()->create([
            'prompt' => $prompt,
            'model' => 'text-davinci-003',
            'max_tokens' => 1000,
            'temperature' => 0.7,
            'top_p' => 1,
            'n' => 1,
            'stream' => false,
            'logprobs' => null,
            'stop' => ['\n'],
        ]);

        $responseText = nl2br(trim($response['choices'][0]['text']));

        return $responseText;
    }
}
