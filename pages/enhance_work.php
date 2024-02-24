<?php

$env = parse_ini_file("../.env");
$API_KEY = getenv('GEMINI_API_KEY');

$description = $_POST["prompt"];

$data = array(
    "contents" => array(
        array(
            "parts" => array(
                array(
                    "text" => "Enhance this work description for my resume in 150 words without any formatting\n" . $description,
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
$result = file_get_contents('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $API_KEY, false, $context);

$text = json_decode($result, true);
$output = $text['candidates'][0]['content']['parts'][0]['text'];

echo $output;
