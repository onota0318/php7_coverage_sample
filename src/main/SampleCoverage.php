<?php
declare(strict_types = 1); // 厳密型にしとく
namespace Php7Cov;


/**
 * 新構文サンプル
 */
class SampleCoverage
{
    private $stackErrors = [];

    /**
     *
     */
    public function __construct()
    {
        ini_set('assert.exception', '1');
        set_exception_handler([$this, "handleException"]);
    }

    /**
     *
     */
    public function handleException(Throwable $e)
    {
        $this->stackErrors[] = $e;
    }

    /**
     *
     */
    public function isEnableDbC(string $name) : bool
    {
        assert(false, new \InvalidArgumentException("hogeじゃない[$name]"));

        if (strlen($name) <= 0) {
            return false;
        }

        return true;
    }

    /**
     *
     */
    public function getLastException() : array
    {
        return $this->stackErrors;
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
    public function getNameAtNullMargedSyntax(array $list) : string
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
            ?? "豚野郎"
            ;
    }

    /**
     * closure::call
     * @param int $value value
     * @param int $data  value
     * @return int
     */
    public function executeClosureCall(int $value, int $data) : int
    {
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

        return $closure->call($clazz, $data);
    }


    /**
     * generatorのreturn + 委譲
     */
    public function executeGenerator(int $first, int $second) : array
    {
        $yield1 = function() use($first) {
            for ($iii = 0; $iii < $first; ++$iii) {
                yield $iii;
            }
        };

        $yield2 = (function() use($yield1, $first, $second) {
            yield from $yield1();

            for ($iii = $first; $iii < $second; ++$iii) {
                yield $iii;
            }

            return $second;
        })();

        $res = array();
        foreach ($yield2 as $value) {
            $res[] = $value;
        }

        $res[] = $yield2->getReturn();
        return $res;
    }
}
