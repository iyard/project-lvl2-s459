<?php

namespace App\GenDiff;

function getData($path)
{
    $data = json_decode(trim(file_get_contents($path)), $assoc = true);
    return array_reduce(array_keys($data), function ($acc, $key) use ($data) {
        if ($data[$key] === true) {
            $acc[$key] = 'true';
        } elseif ($data[$key] === false) {
            $acc[$key] = 'false';
        } else {
            $acc[$key] = $data[$key];
        }
        return $acc;
    }, []);
}

function render($coll)
{
    $rendererColl = implode(PHP_EOL, $coll);
    $template = <<<EOD
{
$rendererColl
}
EOD;
    return $template . PHP_EOL;
}

function getDiff($before, $after)
{
    $keys = array_unique(array_merge(array_keys($before), array_keys($after)));
    $fn = function ($acc, $key) use ($before, $after) {
        if (array_key_exists($key, $before) && array_key_exists($key, $after)) {
            if ($before[$key] == $after[$key]) {
                $acc[] = "    {$key}: {$before[$key]}";
            } else {
                $acc[] = "  + {$key}: {$after[$key]}";
                $acc[] = "  - {$key}: {$before[$key]}";
            }
        } elseif (!array_key_exists($key, $before)) {
            $acc[] = "  + {$key}: {$after[$key]}";
        } else {
            $acc[] = "  - {$key}: {$before[$key]}";
        }
        return $acc;
    };
    $diff = array_reduce($keys, $fn, []);
    return $diff;
}

function genDiff($firstPath, $secondPath)
{
    $before = getData($firstPath);
    $after = getData($secondPath);
    $diff = getDiff($before, $after);
    return render($diff);
}
