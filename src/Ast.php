<?php

namespace Differ\Ast;

use function Funct\Collection\union;

function buildAst($dataBefore, $dataAfter)
{
    $keys = union(array_keys($dataBefore), array_keys($dataAfter));
    $accumulateDiff = function ($acc, $key) use ($dataBefore, $dataAfter) {
        $valueBefore = $dataBefore[$key] ?? '';
        $valueAfter = $dataAfter[$key] ?? '';
        if (array_key_exists($key, $dataBefore) && array_key_exists($key, $dataAfter)) {
            if ($valueBefore == $valueAfter) {
                $acc[] = ['diff' => ' ', 'key' => $key, 'value' => $valueBefore];
            } else {
                $acc[] = ['diff' => '+', 'key' => $key, 'value' => $valueAfter];
                $acc[] = ['diff' => '-', 'key' => $key, 'value' => $valueBefore];
            }
        } elseif (!array_key_exists($key, $dataBefore)) {
            $acc[] = ['diff' => '+', 'key' => $key, 'value' => $valueAfter];
        } else {
            $acc[] = ['diff' => '-', 'key' => $key, 'value' => $valueBefore];
        }
        return $acc;
    };
    $diff = array_reduce($keys, $accumulateDiff, []);
    return $diff;
}
