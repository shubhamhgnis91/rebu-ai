<?php

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');;
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pwd = getenv('DB_PASS');

$connection_string = "host=$host port=$port dbname=$dbname user=$user password=$pwd ";

$dbconn = pg_connect($connection_string) or die("Something went worng!");
