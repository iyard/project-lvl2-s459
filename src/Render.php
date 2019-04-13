<?php

namespace Differ\Render;

use function Differ\Renderers\Plain\renderPlain;
use function Differ\Renderers\Pretty\renderPretty;
use function Differ\Renderers\Json\renderJson;

function render($ast, $format)
{
    switch ($format) {
        case 'pretty':
            return renderPretty($ast);
        case 'plain':
            return renderPlain($ast);
        case 'json':
            return renderJson($ast);
        default:
            return renderPretty($ast);
    }
}
