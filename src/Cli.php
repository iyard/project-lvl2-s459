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
    $handle = Docopt :: handle(DOC);
    $firstFile = $handle->args['<firstFile>'];
    $secondFile = $handle->args['<secondFile>'];
    $dir = \getcwd() . DIRECTORY_SEPARATOR;
    $firstFilePath =  $dir . $firstFile;
    $secondFilePath = $dir . $secondFile;
    echo genDiff($firstFilePath, $secondFilePath);
}
