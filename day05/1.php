<?php

$lines = file($argv[1], FILE_IGNORE_NEW_LINES);
$seeds = [];
$seedToSoil = [];
$soilToFertilizer = [];
$fertilizerToWater = [];
$waterToLight = [];
$lightToTemperature = [];
$temperatureToHumidity = [];
$humidityToLocation = [];
$textToMapVar = [
    'seed-to-soil map:' => 'seedToSoil',
    'soil-to-fertilizer map:' => 'soilToFertilizer',
    'fertilizer-to-water map:' => 'fertilizerToWater',
    'water-to-light map:' => 'waterToLight',
    'light-to-temperature map:' => 'lightToTemperature',
    'temperature-to-humidity map:' => 'temperatureToHumidity',
    'humidity-to-location map:' => 'humidityToLocation',
];


$currentMap = null;
foreach ($lines as $line) {
    if ($line === '') continue;

    if (str_contains($line, 'seeds')) {
        $line = trim(preg_replace('/seeds:/', '', $line));
        $seeds = explode(' ', $line);
        continue;
    }

    if (array_key_exists($line, $textToMapVar)) {
        $currentMap = $textToMapVar[$line];
        continue;
    }

    if ($currentMap === null) {
        throw new UnexpectedValueException('no currentMap');
    }

    list($dst, $src, $len) = explode(' ', $line);
    $$currentMap[] = [
        'dst' => (int) $dst,
        'src' => (int) $src,
        'len' => (int) $len,
    ];
}

foreach ($textToMapVar as $var) {
    usort($$var, function ($a, $b) {
        return $a['src'] <=> $b['src'];
    });
}

$lowestLocation = 99999999999999;
foreach ($seeds as $seed) {
    $src = $seed;
    foreach ($textToMapVar as $var) {
        foreach ($$var as $mapping) {
            if ($src >= $mapping['src'] && $src <= $mapping['src'] + $mapping['len']) {
                $diff = $src - $mapping['src'];
                $src = $mapping['dst'] + $diff;
                break;
            }
        }
    }
    if ($src < $lowestLocation) {
        $lowestLocation = $src;
    }
}

echo "lowest location: $lowestLocation\n";
