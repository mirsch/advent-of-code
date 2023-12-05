<?php

// test.data 467835
// input.data 78826761
$lines = file($argv[1], FILE_IGNORE_NEW_LINES);

function isAdjacentChar(string $char): bool
{
    return preg_match('/[^\d.]/', $char) === 1;
}

function findGears(array &$lines, string $num, int $row, int $col, array &$gears): void
{
    if ($num === '') return;
    $start = $col - strlen($num);

    $positions = [
        [$row - 1, $start - 1], [$row - 1, $start], [$row - 1, $start + 1], [$row - 1, $col - 1], [$row - 1, $col], [$row - 1, $col - 1],
        [$row, $start - 1], [$row, $col],
        [$row + 1, $start - 1], [$row + 1, $start], [$row + 1, $start + 1], [$row + 1, $col - 1], [$row + 1, $col], [$row + 1, $col - 1]
    ];

    foreach ($positions as $position) {
        if ($position[0] < 0) continue;
        if ($position[1] < 0) continue;
        if ($position[0] >= count($lines)) continue;
        if ($position[1] >= strlen($lines[0])) continue;
        if (!isset($lines[$position[0]][$position[1]])) continue;

        $char = $lines[$position[0]][$position[1]];
        if (isAdjacentChar($char)) {
            if ($char === '*') {
                $gears[$position[0] . '_' . $position[1]][] = $num;
            }
            return;
        }
    }
}

$total = 0;
$gears = [];
for($row = 0; $row < count($lines); $row++) {
    $line = $lines[$row];
    $num = '';
    for($col = 0; $col < strlen($line); $col++) {
        $char = $line[$col];
        if (is_numeric($char)) {
            $num .= $char;
            if ($col < strlen($line) - 1) {
                continue;
            }
            $col++;
        }
        findGears($lines, $num, $row, $col, $gears);
        $num = '';
    }
}
foreach ($gears as $gear) {
    if (count($gear) != 2) continue;
    $total += $gear[0] * $gear[1];
}

echo 'Total: '. $total . "\n";
