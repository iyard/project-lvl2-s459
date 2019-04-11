<?php

namespace Differ\Parser;
use Symfony\Component\Yaml\Yaml;

function parse($fileType, $data)
{
    switch ($fileType) {
        case 'json':
            return json_decode($data, $assoc = true);
            break;
        case 'yml':
            return Yaml::parse($data);
            break;
    }
}
