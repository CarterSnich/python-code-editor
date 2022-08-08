<?php

// python code
$code = $_POST['code'];

// save code to file
$filename = "main.py";
$file = fopen($filename, "w");
fwrite($file, $code);
fclose($file);

// execute python runner helper `runner.py`
$command = 'python runner.py';
$output = shell_exec($command);

// return output
echo json_encode($output);
