<?php

namespace Differ\GenDiff;

use function Differ\Parser\getFileType;
use function Differ\Parser\getData;
use function Differ\Parser\parse;
use function Differ\Ast\buildAst;
use function Differ\Render\render;

function genDiff($pathFileBefore, $pathFileAfter)
{
    $dataBefore = parse(getFileType($pathFileBefore), getData($pathFileBefore));
    $dataAfter = parse(getFileType($pathFileAfter), getData($pathFileAfter));
    $diff = buildAst($dataBefore, $dataAfter);
    return render($diff);
}
