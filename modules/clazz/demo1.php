<?php

class SimpleClass
{
    public $var = 'a default value';

    public function displayVar()
    {
        if (isset($this)) {
            echo '$this is defined (' . get_class($this) . ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
        //echo $this->var , "\n";
        echo $this->var , PHP_EOL;      //PHP_EOL: end of line
    }

    // 方法没有返回值类型
    public function getVal() {
        return "some value";
    }

    static public function staticMethod() {
        echo 'exec static method ...' . "\n";
    }
}

// 1 类实例化与方法调用
// 1.1
$a = new SimpleClass();
$a->displayVar();
(new SimpleClass())->displayVar();
(new SimpleClass)->displayVar();        //上面的简写
// 1.2
$className = 'SimpleClass';
$a = new $className();
$a->displayVar();
// 1.3
$aCopy = new $a;
var_dump($a !== $aCopy);
// 1.4
SimpleClass::staticMethod();

