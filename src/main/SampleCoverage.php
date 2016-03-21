<?php
namespace Php7Cov;

declare(strict_types = 1); // 厳密型にしとく
ini_set('assert.exception', 1);

/**
 * 新構文サンプル
 */
class SampleCoverage
{
    /**
     *
     */
    public function __construct()
    {
        // exception_handlerのcallback
    }

    /**
     *
     */
    public function canScalaTypeHints(string $name, int $value) : bool
    {
        return false;
    }

    /**
     * 無名クラスを返却
     *
     * @param string $name 名前
     * @return Object 無名クラス
     */
    public function getAnonymousClass(string $name) : Object
    {
        return new class($name) {
            private $name = "";

            public function __construct($name)
            {
                $this->name = $name;
            }

            public function getName()
            {
                return __CLASS__ . "[" . $this->name . "]";
            }
        };
    }

    /**
     * Null 合体演算子
     *
     * @param array $list リスト
     * @return string 名前
     */
    public function getName(array ...$list)
    {
        $return $list[0]
             ?? $list[1]
             ?? $list[2]
             ?? $list[3]
             ?? $list[4]
             ?? $list[5]
             ?? $list[6]
             ?? $list[7]
             ?? $list[8]
             ?? $list[9]
             ;
    }

    //http://php.net/manual/ja/migration70.new-features.php
    //Null 合体演算子
    //宇宙船演算子
    //define() を用いた配列定数の定義
    //無名クラス
    //Closure::call()
    //Expectation

    //型違反時のTypeErrorもとりたい
}
