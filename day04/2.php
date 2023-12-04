<?php

$lines = file($argv[1], FILE_IGNORE_NEW_LINES);
$total = 0;
$cardPoints = [];
$cardCounts = [];
foreach ($lines as $line) {
    $line = trim(preg_replace('/Card \d+:/', '', $line));
    $line = preg_replace('/\s\s+/', ' ', $line);
    list($winnerNumbers, $myNumbers) = explode('|', $line);
    $winnerNumbers = explode(' ', trim($winnerNumbers));
    $myNumbers = explode(' ', trim($myNumbers));
    $matching = array_intersect($winnerNumbers, $myNumbers);
    $cardPoints[] = count($matching);
    $cardCounts[] = 1;
}

for($i = 0; $i < count($cardPoints); $i++) {
    for ($j = 1; $j <= $cardPoints[$i]; $j++) {
        if ($i + $j >= count($cardPoints)) {
            break;
        }
        $cardCounts[$i + $j] += $cardCounts[$i];
    }
}

$total = array_sum($cardCounts);
echo "Total: $total\n";
