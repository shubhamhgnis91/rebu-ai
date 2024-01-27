<?php

$env = parse_ini_file('../.env');

$host = $env['DB_HOST'];
$port = $env['DB_PORT'];
$dbname = $env['DB_NAME'];
$user = $env['DB_USER'];
$pwd = $env['DB_PASS'];

$connection_string = "host=$host port=$port dbname=$dbname user=$user password=$pwd ";

$dbconn = pg_connect($connection_string) or die("Something went worng!");
