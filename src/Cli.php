<?php
namespace Gendiff\Cli;

use \Docopt;
use function \cli\line;
use function \cli\prompt;

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
    $args = Docopt::handle(DOC);
}
