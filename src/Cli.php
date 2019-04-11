<?php
namespace Differ\Cli;

use \Docopt;
use function Differ\GenDiff\genDiff;

const DOC = <<<DOC
Generate diff

Usage:
  gendiff (-h|--help)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help     	Show this screen
  --format <fmt>	Report format [default: pretty]
  --version     	Show version

DOC;

function run()
{
    $handle = Docopt::handle(DOC);
    $fileBefore = $handle->args['<firstFile>'];
    $fileAfter = $handle->args['<secondFile>'];
    $format = $handle->args['--format'];
    $isFullPath = function ($path) {
        return $path[0] === DIRECTORY_SEPARATOR;
    };
    $dir = \getcwd() . DIRECTORY_SEPARATOR;
    $pathFileBefore = $isFullPath($fileBefore) ? $fileBefore : $dir . $fileBefore;
    $pathFileAfter = $isFullPath($fileAfter) ? $fileAfter : $dir . $fileAfter;

    echo genDiff($pathFileBefore, $pathFileAfter, $format);
}
