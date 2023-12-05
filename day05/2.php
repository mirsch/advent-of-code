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

/*
foreach ($textToMapVar as $var) {
    usort($$var, function ($a, $b) {
        return $a['src'] <=> $b['src'];
    });
}
*/
// slowest possible solution
$lowestLocation = $lowestSeed = 99999999999999;
for($i = 0; $i < count($seeds); $i+=2) {
    echo $i . '/' . count($seeds) . "\n";
    for($j = $seeds[$i]; $j < $seeds[$i] + $seeds[$i + 1]; $j++) {
        $src = $j;
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
            $lowestSeed = $j;
        }
    }
}

echo "lowest seed: $lowestSeed\n";
echo "lowest location: $lowestLocation\n"; // 63179500 in 03:08h lol
