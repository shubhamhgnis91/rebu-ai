<?php
require '../vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = getenv('OPENAI_API_KEY');

$open_ai = new OpenAi($open_ai_key);

$description = $_POST["prompt"];

$prompt = "enhance this bio (about myself) for my resume in 150 words" . "\n" . $description;

$complete = $open_ai->completion([
    'model' => 'gpt-3.5-turbo-instruct',
    'prompt' => $prompt,
    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
 ]);


$resposne = json_decode($complete, true);

$enhancedDesc = $resposne['choices'][0]['text'];

echo $enhancedDesc;

