<?php

namespace Differ\Parser;
use Symfony\Component\Yaml\Yaml;

function parse($filePath)
{
    $data = trim(file_get_contents($filePath));
    switch (getFiletype($filePath)) {
        case 'json':
            return parseJson($data);
            break;
        case 'yml':
            return parseYml($data);
            break;
    }
}

function getFiletype($filePath)
{
    $pathParts = pathinfo($filePath);
    return $pathParts['extension'];
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

function parseJson($data)
{
    $decodedData = json_decode($data, $assoc = true);
    return replaceBool($decodedData);
}

function parseYml($data)
{
    return replaceBool(Yaml::parse($data));
}
