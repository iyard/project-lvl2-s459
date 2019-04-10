<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\GenDiff\genDiff;

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
        $jsonExpected = trim(file_get_contents(__DIR__ . '/testData/JsonExpected.txt')) . PHP_EOL;
        $jsonBefore = __DIR__ . '/testData/JsonBefore.json';
        $jsonAfter = __DIR__ . '/testData/JsonAfter.json';
        
        $ymlExpected = trim(file_get_contents(__DIR__ . '/testData/ymlExpected.txt')) . PHP_EOL;
        $ymlBefore = __DIR__ . '/testData/ymlBefore.yml';
        $ymlAfter = __DIR__ . '/testData/ymlAfter.yml';

        return [
            [$jsonExpected, $jsonBefore, $jsonAfter],
            [$ymlExpected, $ymlBefore, $ymlAfter]
        ];
    }
}
