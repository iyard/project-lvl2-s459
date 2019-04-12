<?php

namespace Differ\GenDiff;

use function Differ\Parser\parse;
use function Differ\Ast\buildAst;
use function Differ\Render\render;

function genDiff($pathFileBefore, $pathFileAfter, $format)
{
    $dataBefore = parse(getFileExtention($pathFileBefore), getData($pathFileBefore));
    $dataAfter = parse(getFileExtention($pathFileAfter), getData($pathFileAfter));
    $ast = buildAst($dataBefore, $dataAfter);
    return render($ast, $format);
}

function getData($filePath)
{
    return trim(file_get_contents($filePath));
}

function getFileExtention($filePath)
{
    $pathParts = pathinfo($filePath);
    return $pathParts['extension'];
}
