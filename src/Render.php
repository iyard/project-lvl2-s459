<?php

namespace Differ\Render;

use function Differ\Views\Plain\plain;
use function Differ\Views\Pretty\pretty;

function render($ast, $format)
{
    switch ($format) {
        case 'pretty':
            return pretty($ast);
            break;
        default:
            return pretty($ast);
            break;
    }
}
