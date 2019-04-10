<?php

namespace Differ\Render;

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
