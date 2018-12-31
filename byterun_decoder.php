#!/usr/bin/php
<?php

/*
 * Byterun Protector for PHP Decoder
 * author:  @twosevenzero
 * date:    December 31, 2018
 * usage:   byterun_decoder.php ENCODED_FILE
 */

// Import File and Normalize
$input_file = preg_replace('/\s*/m', '', file_get_contents($argv[1]));
$input_file = preg_replace('/php\$/', 'php $', $input_file);

// Base64 Encoded Source Code
$X = preg_match('/\$_X=\'(.*)\';/', $input_file, $matches);
$_X = $matches[1];

// Base64 Encoded Decode Algoritm
$D = preg_match('/\$_D\(\'(.*)\'\)\)/', $input_file, $matches);
$_D = $matches[1];

$algorithm = preg_replace('/\$_R=ereg_replace.*/', '', base64_decode($_D));
eval($algorithm);

echo $_X;

?>
