<?php
declare(strict_types = 1); // 厳密型にしとく
namespace Php7Cov;


/**
 * 新構文サンプル
 */
class SampleCoverage
{
    /**
     * 以下を実施
     *  ・スカラー型宣言
     *  ・戻り値の型宣言
     *  ・Null 合体演算子
     * @param array $list リスト
     * @return string 名前
     */
    public function getName(array $list) : string
    {
        return $list[0]
            ?? $list[1]
            ?? $list[2]
            ?? $list[3]
            ?? $list[4]
            ?? $list[5]
            ?? $list[6]
            ?? $list[7]
            ?? $list[8]
            ?? $list[9]
            ??  "豚野郎"
            ;
    }


    /**
     * 以下を実施
     *  ・スカラー型宣言
     *  ・戻り値の型宣言
     *  ・無名クラス
     *  ・Closure::call()
     * @param int $value value
     * @param int $data  value
     * @return int
     */
    public function executeClosureCall(int $value, int $data) : int
    {
        // 無名クラス
        $clazz = new class($value) {
            private $value = 0;

            public function __construct(int $value)
            {
                $this->value = $value;
            }

            public function getValue()
            {
                return $this->value;
            }
        };

        $closure = function(int $data) {
            return $this->getValue() + $data;
        };

        // Closure::call()
        return $closure->call($clazz, $data);
    }


    /**
     * 以下を実施
     *  ・Expectation
     *  ・ジェネレータでの return
     *  ・ジェネレータの委譲
     *
     * @param int $first
     * @param int $second
     * @param bool $is_return
     * @return array
     *
     * @throws AssertionError
     */
    public function executeGenerator(int $first, int $second, bool $is_return = true) : array
    {
        /* @buief
         * 1: アサーションに失敗した場合には、 exception で指定したオブジェクトをスローするか、
         *    exception を指定していない場合は AssertionError オブジェクトをスローします。
         * 0: 先述の Throwable を使ったり生成したりしますが、 そのオブジェクト上で警告を生成するだけ
         *    であり、スローしません (PHP 5 と互換性のある挙動です)。
         */
        ini_set('assert.exception', '1');

        // Expectation
        assert($first < $second
            ,new \AssertionError("数字指定がおかしい: first[$first] second[$second]"));


        // 委譲されるジェネレータ
        $yield1 = function() use($first) {
            for ($iii = 0; $iii < $first; ++$iii) {
                yield $iii;
            }
        };

        // ジェネレータの委譲
        // [yield from $yield1();]のとこ
        $yield2 = (function() use($yield1, $first, $second) {
            yield from $yield1();

            for ($iii = $first; $iii < $second; ++$iii) {
                yield $iii;
            }
            // ここのreturnをgetReturn()で返す
            return $second;
        })();

        $res = array();
        foreach ($yield2 as $value) {
            $res[] = $value;
        }

        // ジェネレータでの return
        if ($is_return) {
            $res[] = $yield2->getReturn();
        }

        return $res;
    }
}
