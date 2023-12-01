<?php

$content = file_get_contents($argv[1]);
$lines = explode("\n", $content);
$sum = 0;
foreach ($lines as $line) {
    if ($line === '') continue;
    preg_match_all('/[\d]/', $line, $matches);
    $num = $matches[0][0] . $matches[0][count($matches[0]) - 1];
    $sum += (int) $num;
}
echo $sum . "\n";
