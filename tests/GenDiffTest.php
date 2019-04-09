<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use function App\GenDiff\genDiff;

const TEST_DATA_DIR = "/tests/testData/";

class GenDiffTest extends TestCase
{
	/**
	 * @dataProvider additionProvider
	 */
	public function testGenDiff($expected, $before, $after)
	{
		$this->assertEquals($expected, genDiff($before, $after));

	}

	public function additionProvider ()
	{
		$expected1 = trim(file_get_contents(__DIR__ . "/testData/JsonExpected.txt")) . PHP_EOL;
		$before1 = \getcwd() . TEST_DATA_DIR . "JsonBefore.json";
		$after1 = \getcwd() . TEST_DATA_DIR . "JsonAfter.json";

		return [
			[$expected1, $before1, $after1]
		];
	}
}
