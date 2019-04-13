<?php

namespace Differ\Renderers\Json;

function json($ast)
{
    return (json_encode($ast));
}
