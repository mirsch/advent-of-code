<?php

$lines = file($argv[1], FILE_IGNORE_NEW_LINES);
$total = 0;
foreach ($lines as $line) {
    $line = trim(preg_replace('/Card \d+:/', '', $line));
    $line = preg_replace('/\s\s+/', ' ', $line);
    list($winnerNumbers, $myNumbers) = explode('|', $line);
    $winnerNumbers = explode(' ', trim($winnerNumbers));
    $myNumbers = explode(' ', trim($myNumbers));
    $matching = array_intersect($winnerNumbers, $myNumbers);
    if (! count($matching)) continue;
    $total += pow(2, (count($matching) -1));
}
echo "Total: $total\n";
