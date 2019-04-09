<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\GenDiff\genDiff;

const TEST_DATA_DIR = "/tests/testData/";

class GenDiffTest extends TestCase
{
    /**
    * @dataProvider additionProvider
    */
    public function testGenDiff($expected, $valueBefore, $valueAfter)
    {
        $this->assertEquals($expected, genDiff($valueBefore, $valueAfter));
    }

    public function additionProvider()
    {
        $dir = \getcwd() . TEST_DATA_DIR;
        $jsonExpected = trim(file_get_contents(__DIR__ . "/testData/jsonExpected.txt")) . PHP_EOL;
        $jsonBefore = $dir . "jsonBefore.json";
        $jsonAfter = $dir . "jsonAfter.json";
        
        $ymlExpected = trim(file_get_contents(__DIR__ . "/testData/ymlExpected.txt")) . PHP_EOL;
        $ymlBefore = $dir . "ymlBefore.yml";
        $ymlAfter = $dir . "ymlAfter.yml";

        return [
            [$jsonExpected, $jsonBefore, $jsonAfter],
            [$ymlExpected, $ymlBefore, $ymlAfter]
        ];
    }
}
