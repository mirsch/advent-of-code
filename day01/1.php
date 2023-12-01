<?php

$lines = file($argv[1]);
$sum = 0;
foreach ($lines as $line) {
    preg_match_all('/[\d]/', $line, $matches);
    $num = $matches[0][0] . $matches[0][count($matches[0]) - 1];
    $sum += (int) $num;
}
echo $sum . "\n";
