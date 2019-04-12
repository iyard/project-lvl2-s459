<?php

namespace Differ\Render;

use function Differ\Renderers\Plain\plain;
use function Differ\Renderers\Pretty\pretty;

function render($ast, $format)
{
    switch ($format) {
        case 'pretty':
            return pretty($ast);
            break;
        case 'plain':
            return plain($ast);
            break;
        default:
            return pretty($ast);
            break;
    }
}
