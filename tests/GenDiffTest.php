<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\GenDiff\genDiff;

class GenDiffTest extends TestCase
{
    /**
    * @dataProvider additionProvider
    */
    public function testGenDiff($expected, $valueBefore, $valueAfter, $format)
    {
        $this->assertEquals($expected, genDiff($valueBefore, $valueAfter, $format));
    }

    public function additionProvider()
    {
        $jsonExpected = trim(file_get_contents(__DIR__ . '/testData/JsonExpected.txt'));
        $jsonBefore = __DIR__ . '/testData/JsonBefore.json';
        $jsonAfter = __DIR__ . '/testData/JsonAfter.json';
        
        $ymlExpected = trim(file_get_contents(__DIR__ . '/testData/ymlExpected.txt'));
        $ymlBefore = __DIR__ . '/testData/ymlBefore.yml';
        $ymlAfter = __DIR__ . '/testData/ymlAfter.yml';

        $jsonAstExpected = trim(file_get_contents(__DIR__ . '/testData/JsonAstExpected.txt'));
        $jsonAstBefore = __DIR__ . '/testData/JsonAstBefore.json';
        $jsonAstAfter = __DIR__ . '/testData/JsonAstAfter.json';

        return [
            [$jsonExpected, $jsonBefore, $jsonAfter, 'pretty'],
            [$ymlExpected, $ymlBefore, $ymlAfter, 'pretty'],
            [$jsonAstExpected, $jsonAstBefore, $jsonAstAfter, 'pretty']
        ];
    }
}
