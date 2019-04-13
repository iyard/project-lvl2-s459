<?php

namespace Differ\Renderers\Json;

function renderJson($ast)
{
    return (json_encode($ast));
}
