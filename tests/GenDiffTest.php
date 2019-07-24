<?php

namespace Gendiff\GenDiff;
use PHPUnit\Framework\TestCase;

class GenDiffTest extends TestCase
{
    public function testTest()
    {
        $this->assertEquals(3, 1 + 2);
        $this->assertEquals(4, 2 + 2);
    }

    public function testGenDiffJson()
    {
        $first = file_get_contents(__DIR__ . '/examples/before.json');
        $second = file_get_contents(__DIR__ . '/examples/after.json');
        $expected = file_get_contents(__DIR__ . '/examples/expected/result.txt');
        $this->assertEquals($expected, genDiffJson($first, $second));
    }
}
