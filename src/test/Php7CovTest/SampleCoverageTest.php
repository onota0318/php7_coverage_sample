<?php
namespace Php7CovTest;

use Php7Cov\SampleCoverage;

/**
 * てすと
 */
class SampleCoverageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function test_NULL合体演算子のテスト()
    {
        $sample = new SampleCoverage();

        $actual = $sample->getNameAtNullMargedSyntax(["hoge"]);
        $this->assertEquals("hoge", $actual);

        $actual = $sample->getNameAtNullMargedSyntax([null, null, null, null, "hoge"]);
        $this->assertEquals("hoge", $actual);

        $actual = $sample->getNameAtNullMargedSyntax([null]);
        $this->assertEquals("豚野郎", $actual);
    }

    /**
     * @test
     */
    public function test_ClosureCallのテスト()
    {/*
        $sample = new SampleCoverage();

        $expected = 5;
        $actual   = $sample->executeClosureCall(2, 3);
        $this->assertEquals($expected, $actual);
  */  }


}
