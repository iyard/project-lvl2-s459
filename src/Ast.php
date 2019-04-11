<?php

namespace Differ\Ast;

use function Funct\Collection\union;

function buildNodeStructure($type, $key, $valueBefore, $valueAfter, $children)
{
    return [
        'type' => $type,
        'key' => $key,
        'valueBefore' => $valueBefore,
        'valueAfter' => $valueAfter,
        'children' => $children
    ];
}

function boolToStr($bool)
{
    return $bool ? 'true' : 'false';
}

function buildAst($dataBefore, $dataAfter)
{
    $keys = union(array_keys($dataBefore), array_keys($dataAfter));
    $accumulateData = function ($acc, $key) use ($dataBefore, $dataAfter) {
        $valuePrepareBefore = $dataBefore[$key] ?? '';
        $valuePrepareAfter = $dataAfter[$key] ?? '';
        $valueBefore = is_bool($valuePrepareBefore) ? boolToStr($valuePrepareBefore) : $valuePrepareBefore;
        $valueAfter = is_bool($valuePrepareAfter) ? boolToStr($valuePrepareAfter) : $valuePrepareAfter;
        
        if (array_key_exists($key, $dataBefore) && array_key_exists($key, $dataAfter)) {
            if (is_array($valueBefore) && is_array($valueAfter)) {
                $acc[] = buildNodeStructure('node', $key, null, null, buildAst($valueBefore, $valueAfter));
            } elseif ($valueBefore == $valueAfter) {
                $acc[] = buildNodeStructure('unchanged', $key, $valueBefore, $valueAfter, null);
            } else {
                $acc[] = buildNodeStructure('changed', $key, $valueBefore, $valueAfter, null);
            }
        } elseif (!array_key_exists($key, $dataBefore)) {
            $acc[] = buildNodeStructure('added', $key, null, $valueAfter, null);
        } else {
            $acc[] = buildNodeStructure('deleted', $key, $valueBefore, null, null);
        }
        return $acc;
    };
    $ast = array_reduce($keys, $accumulateData, []);
    return $ast;
}
