<?php

namespace Differ\Renderers\Pretty;

use function Funct\Collection\flattenAll;

function pretty($ast)
{
    $mappedAst =  array_map(function ($data) {
        return getPretty($data, 0);
    }, $ast);
    return mappedAstToString($mappedAst);
}

function getPretty($data, $level)
{
        ['type' => $type,
        'key' => $key,
        'valueBefore' => $valueBefore,
        'valueAfter' => $valueAfter,
        'children' => $children] = $data;
        $valueBefore = is_array($valueBefore) ? getRecurseData($valueBefore, $level) : $valueBefore;
        $valueAfter = is_array($valueAfter) ? getRecurseData($valueAfter, $level) : $valueAfter;

        switch ($type) {
            case 'node':
                return [
                    getOffset($level) . "    {$key}: {",
                    array_map(function ($data) use ($level) {
                        return getPretty($data, $level + 1);
                    }, $children),
                    getOffset($level) . "    }"
                ];
            case 'unchanged':
                return getOffset($level) . "    {$key}: {$valueBefore}";
            
            case 'changed':
                return [
                    getOffset($level) . "  + {$key}: {$valueAfter}",
                    getOffset($level) . "  - {$key}: {$valueBefore}"
                ];
            
            case 'deleted':
                return getOffset($level) . "  - {$key}: {$valueBefore}";
            
            case 'added':
                return getOffset($level) . "  + {$key}: {$valueAfter}";
        }
}
function getRecurseData($data, $level)
{
    $recurseData = array_map(function ($key) use ($data, $level) {
        return [PHP_EOL . getOffset($level + 1) . "    {$key}: {$data[$key]}"];
    }, array_keys($data));
    return implode('', flattenAll(array_merge(['{'], $recurseData, [PHP_EOL . getOffset($level) . '    }'])));
}
function getOffset($level)
{
    return str_repeat(' ', $level * 4);
}

function mappedAstToString($mappedAst)
{
    return '{' . PHP_EOL . implode(PHP_EOL, flattenAll($mappedAst)) . PHP_EOL . '}';
}
