<?php

$API_KEY = getenv('GEMINI_API_KEY');

$description = $_POST["prompt"];

$data = array(
    "contents" => array(
        array(
            "parts" => array(
                array(
                    "text" => "enhance this bio (about myself) for my resume in 150 words without any formatting\n" . $description,
                )
            )
        )
    )
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $API_KEY, false, $context);

$text = json_decode($result, true);
$output = $text['candidates'][0]['content']['parts'][0]['text'];

echo $output;

