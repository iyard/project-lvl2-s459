<?php

namespace Differ\GenDiff;

use function Differ\Parser\parse;

function render($data)
{
    $rendererData = array_reduce($data, function ($acc, $item) {
        $acc[] = "  {$item['diff']} {$item['key']}: {$item['value']}";
        return $acc;
    }, []);
    $stringData = implode(PHP_EOL, $rendererData);
    $template = "{\n$stringData\n}" . PHP_EOL;
    return $template;
}

function getDiff($dataBefore, $dataAfter)
{
    $keys = array_unique(array_merge(array_keys($dataBefore), array_keys($dataAfter)));
    $accumulateDiff = function ($acc, $key) use ($dataBefore, $dataAfter) {
        if (array_key_exists($key, $dataBefore) && array_key_exists($key, $dataAfter)) {
            if ($dataBefore[$key] == $dataAfter[$key]) {
                $acc[] = ['diff' => ' ', 'key' => $key, 'value' => $dataBefore[$key]];
            } else {
                $acc[] = ['diff' => '+', 'key' => $key, 'value' => $dataAfter[$key]];
                $acc[] = ['diff' => '-', 'key' => $key, 'value' => $dataBefore[$key]];
            }
        } elseif (!array_key_exists($key, $dataBefore)) {
            $acc[] = ['diff' => '+', 'key' => $key, 'value' => $dataAfter[$key]];
        } else {
            $acc[] = ['diff' => '-', 'key' => $key, 'value' => $dataBefore[$key]];
        }
        return $acc;
    };
    $diff = array_reduce($keys, $accumulateDiff, []);
    return $diff;
}

function genDiff($firstFilePath, $secondFilePath)
{
    $dataBefore = parse($firstFilePath);
    $dataAfter = parse($secondFilePath);
    $diff = getDiff($dataBefore, $dataAfter);
    return render($diff);
}
