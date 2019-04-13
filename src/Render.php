<?php

namespace Differ\Render;

use function Differ\Renderers\Plain\plain;
use function Differ\Renderers\Pretty\pretty;
use function Differ\Renderers\Json\json;

function render($ast, $format)
{
    switch ($format) {
        case 'pretty':
            return pretty($ast);
        case 'plain':
            return plain($ast);
        case 'json':
            return json($ast);
        default:
            return pretty($ast);
    }
}
