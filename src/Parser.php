<?php

namespace Differ\Parser;
use Symfony\Component\Yaml\Yaml;

function parse($fileType, $data)
{
    switch ($fileType) {
        case 'json':
            return parseJson($data);
            break;
        case 'yml':
            return parseYml($data);
            break;
    }
}

function parseJson($data)
{
    $decodedData = json_decode($data, $assoc = true);
    return replaceBool($decodedData);
}

function parseYml($data)
{
    return replaceBool(Yaml::parse($data));
}

function boolToStr($bool)
{
    return $bool ? 'true' : 'false';
}

function replaceBool($data)
{
    return array_reduce(array_keys($data), function ($acc, $key) use ($data) {
        $acc[$key] = is_bool($data[$key]) ? boolToStr($data[$key]) : $data[$key];
        return $acc;
    }, []);
}

function getData($filePath)
{
    return trim(file_get_contents($filePath));
}

function getFileType($filePath)
{
    $pathParts = pathinfo($filePath);
    return $pathParts['extension'];
}
