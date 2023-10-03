<?php

return [
    'url' => env('OPENAI_URL', 'https://api.openai.com/v1/chat/completions'),
    'api_key' => env('OPENAI_API_KEY'),
    'model' => env('OPENAI_MODEL', 'gpt-4'),
];
