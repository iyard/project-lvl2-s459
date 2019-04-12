<?php

namespace Differ\Renderers\Plain;

use function Funct\Collection\flattenAll;

function plain($ast)
{
    $mappedAst = array_map(function ($data) {
        return getPlain($data, '');
    }, $ast);
    return mappedAstToString($mappedAst);
}

function getPlain($data, $nodeKey)
{
    ['type' => $type,
    'key' => $key,
    'valueBefore' => $valueBefore,
    'valueAfter' => $valueAfter,
    'children' => $children] = $data;

    $valueBefore = is_array($valueBefore) ? 'complex value' : $valueBefore;
    $valueAfter = is_array($valueAfter) ? 'complex value' : $valueAfter;
    $nodeFullKey = ($nodeKey == '') ? $key : $nodeKey . '.' . $key;

    $mappedChildren = function ($child) use ($nodeFullKey) {
        return getPlain($child, $nodeFullKey);
    };

    switch ($type) {
        case 'node':
            return [array_map($mappedChildren, $children)];

        case 'changed':
            return ["Property '{$nodeFullKey}' was changed. From '{$valueBefore}' to '{$valueAfter}'"];
        
        case 'deleted':
            return ["Property '{$nodeFullKey}' was removed"];
        
        case 'added':
            return ["Property '{$nodeFullKey}' was added with value: '{$valueAfter}'"];
    }
}

function mappedAstToString($mappedAst)
{
    $filteredData = array_filter(flattenAll($mappedAst), function ($data) {
        return $data != '';
    });
    return implode(PHP_EOL, $filteredData) . PHP_EOL;
}
