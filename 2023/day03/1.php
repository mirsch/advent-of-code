<?php

// test.data 4361
// test2.data 925
// test3.data 413
// test4.data 62
// input.data 533784
$lines = file($argv[1], FILE_IGNORE_NEW_LINES);

function isAdjacentChar(string $char): bool
{
    return preg_match('/[^\d.]/', $char) === 1;
}

function hasAdjacent(array &$lines, string $num, int $row, int $col): bool
{
    if ($num === '') return false;
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
            return true;
        }
    }

    return false;
}

$total = 0;
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
        if (hasAdjacent($lines, $num, $row, $col)) {
            $total += (int) $num;
        }
        $num = '';
    }
}

echo 'Total: '. $total . "\n";
