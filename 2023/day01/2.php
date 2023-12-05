<?php

$lines = file($argv[1]);
$sum = 0;
foreach ($lines as $line) {
    $line = str_replace(['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'], ['o1e', 't2o', 't3e', 'f4r', 'f5e', 's6x', 's7n', 'e8t', 'n9e'], $line);
    preg_match_all('/\d/', $line, $matches);
    $num = $matches[0][0] . $matches[0][count($matches[0]) - 1];
    $sum += (int) $num;
}
echo $sum . "\n";
