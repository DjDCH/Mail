<?php

ini_set('display_errors', 1);
error_reporting(-1);

mb_internal_encoding('UTF-8');

function _println($string)
{
    echo $string . "\n";
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Mail.php';
