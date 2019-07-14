[![Build Status](https://travis-ci.org/iyard/project-lvl2-s459.svg?branch=master)](https://travis-ci.org/iyard/project-lvl2-s459)
[![Maintainability](https://api.codeclimate.com/v1/badges/d226c1b12e56593a2277/maintainability)](https://codeclimate.com/github/iyard/project-lvl2-s459/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/d226c1b12e56593a2277/test_coverage)](https://codeclimate.com/github/iyard/project-lvl2-s459/test_coverage)

# About
gendiff - search for differences in the configuration files

# Installation
The easiest way to get started brain-games install using **composer** with the following command:
```
composer global require i-yard/gendiff:dev-master
```
Make sure you have the composer bin dir in your PATH. The default value is `~/.composer/vendor/bin/`, but you can check the value that you need to use by running `composer global config bin-dir --absolute`.

# How to use
Usage:
  gendiff (-h|--help)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help     	Show this screen
  --format <fmt>	Report format [default: pretty]
  --version     	Show version

[Example](https://asciinema.org/a/djmltHYsmolMEznqystOixBbf)