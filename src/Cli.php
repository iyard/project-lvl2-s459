<?php
namespace App\Cli;

use \Docopt;
use function App\GenDiff\genDiff;

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
    $firstPath =  $dir . $firstFile;
    $secondPath = $dir . $secondFile;
    echo genDiff($firstPath, $secondPath);
}
