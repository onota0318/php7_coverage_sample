<?php
namespace Php7CovTest;

use Php7Cov\SampleCoverage;

/**
 * てすと
 */
class SampleCoverageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * NULL合体演算子のテスト
     * @test
     */
    public function test_NULL合体演算子のテスト()
    {
        $sample = new SampleCoverage();

        // 0番目
        $actual = $sample->getName(["hoge"]);
        $this->assertEquals("hoge", $actual);

        // 1番目
        $actual = $sample->getName([null, "hoge"]);
        $this->assertEquals("hoge", $actual);

        // 2番目
        $actual = $sample->getName([null, null, "hoge"]);
        $this->assertEquals("hoge", $actual);

        // 3番目
        $actual = $sample->getName([null, null, null, "hoge"]);
        $this->assertEquals("hoge", $actual);

        // 4番目
        $actual = $sample->getName([null, null, null, null, "hoge"]);
        $this->assertEquals("hoge", $actual);

        // 全部null
        $actual = $sample->getName([null]);
        $this->assertEquals("豚野郎", $actual);
    }

    /**
     * ClosureCallのテスト
     * @test
     */
    public function test_ClosureCallのテスト()
    {
        $sample = new SampleCoverage();

        $expected = 5;
        $actual   = $sample->executeClosureCall(2, 3);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Expectationのテスト
     * @test
     */
    public function test_Expectationのテスト()
    {
        $sample = new SampleCoverage();

        // 例外パターン
        try {
            $sample->executeGenerator(2, 1, $is_return = false);
            $this->fail("例外投げられてないのはおかしい");
        }
        catch (\AssertionError $ae) {
            $expected = "数字指定がおかしい: first[2] second[1]";
            $this->assertEquals($expected, $ae->getMessage());
        }

        // 同値も例外
        try {
            $sample->executeGenerator(2, 2, $is_return = false);
            $this->fail("例外投げられてないのはおかしい");
        }
        catch (\AssertionError $ae) {
            $expected = "数字指定がおかしい: first[2] second[2]";
            $this->assertEquals($expected, $ae->getMessage());
        }

        // 正常系
        try {
            $res = $sample->executeGenerator(2, 3, $is_return = false);
            $this->assertCount(3, $res);
        }
        catch (\AssertionError $ae) {
            $this->fail("2と3で例外投げられるのはおかしい");
        }
    }

    /**
     * ジェネレータのテスト
     * @test
     */
    public function test_ジェネレータのテスト()
    {
        $sample = new SampleCoverage();

        // is_returnあり
        $res = $sample->executeGenerator(1, 3);
        $this->assertCount(4, $res);
        $this->assertEquals(0, $res[0]);
        $this->assertEquals(1, $res[1]);
        $this->assertEquals(2, $res[2]);
        $this->assertEquals(3, $res[3]);

        // is_returnなし
        $res = $sample->executeGenerator(2, 4, $is_return = false);
        $this->assertCount(4, $res);
        $this->assertEquals(0, $res[0]);
        $this->assertEquals(1, $res[1]);
        $this->assertEquals(2, $res[2]);
        $this->assertEquals(3, $res[3]);
        $this->assertTrue(empty($res[4]));
    }
}
