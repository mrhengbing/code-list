<?php
/**
 * @Author: mrhengbing
 * @Create time:   2017-03-10 11:47:38
 * @Last Modified by:   mrhengbing
 * @Last Modified time: 2017-03-10 15:03:05
 * @Email:  415671062@qq.com
 * @-----魔术方法用法----------
 */
class Magic {
    protected $demo = 'magic';
    protected $str = 'example';

    /**
     * 当对象被创建时调用，一般用来执行一些初始化任务，该方法又叫构造方法
     */
    public function __construct(){
        echo '__construct is called.<br>';
    }

    /**
     * 当对象被销毁、结束或关闭时被调用
     */
    public function __destruct(){
        echo '<br>__destruct is called.<br>';
    }

    /**
     * 当给不可访问或不存在的属性赋值时被调用
     * @param [type] $name  属性名
     * @param [type] $value 属性值
     */
    public function __set($name, $value){
        echo $name.'-'.$value.', ';
        echo '__set is called.<br>';
    }

    /**
     * 当读取不可访问或不存在的属性时被调用
     * @param  [type] $name 属性名
     */
    public function __get($name){
        echo $name.', ';
        echo '__get is called.<br>';
    }

    /**
     * 对不可访问或不存在的属性使用isset()或empty()时被调用
     * @param  [type]  $name 属性名
     */
    public function __isset($name){
        echo $name.', ';
        echo '__isset is called.<br>';
    }

    /**
     * 对不可访问或不存在的属性使用unset()时被调用
     * @param [type] $name 属性名
     */
    public function __unset($name){
        echo $name.', ';
        echo '__unset is called.<br>';
    }

    /**
     * 当调用不可访问或不存在的方法时被调用
     * @param  [type] $name     方法名
     * @param  [type] $value    [description]
     */
    public function __call($name, $value){
        echo $name.'-'.implode(',', $value).', ';
        echo '__call is called.<br>';
    }

    /**
     * 当调用不可访问或不存在的静态方法时被调用
     * @param  [type] $name     方法名
     * @param  [type] $value    [description]
     */
    public static function __callStatic($name, $value){
        echo $name.'-'.implode(',', $value).', ';
        echo '__callStatic is called.<br>';
    }   

    /**
     * 当对象被复制时调用
     * @return [type] [description]
     */
    public function __clone(){
        echo '__clone is called.<br>';
    }

    /**
     * 当使用serialize时被调用，可以用于清理对象，并返回一个包含对象中所有应被序列化的变量名称的数组
     * @return array [description]
     */
    public function __sleep(){
        echo '__sleep is called.<br>';
        return array('demo');
    }

    /**
     * 当使用unserialize时被调用，经常用在反序列化操作中，例如重新建立数据库连接，或执行其它初始化操作。
     */
    public function __wakeup(){
        echo '__wakeup is called.<br>';
        $this->demo = '11111';
    }

    /**
     * 当一个类被当成字符串时调用
     * @return string [description]
     */
    public function __toString(){
        echo '__toString is called.';
        return $this->str.'<br>';
    }

    /**
     * 当尝试以函数方式调用对象时被调用
     * @return [type] [description]
     */
    public function __invoke(){
        echo '__invoke is called.<br>';
    }

    /**
     * 当调用var_export()导出类时，此静态方法会被调用，以__set_state的返回值做为var_export的返回值
     * @return [type] [description]
     */
    public static function __set_state(){
        echo '__set_state is called.<br>';
    }

    /**
     * 当使用用var_dump()打印对象时被调用，适用于PHP5.6
     * @return [type] [description]
     */
    public function __debugInfo(){
        echo '__debuginfo is called.<br>';
    }

}

$test = new Magic();  //__construct被调用，输出“__construct is called.”
$test->a = '111';   //__set被调用，输出“a-111, __set is called.”
echo $test->b;      //__get被调用，输出“b, __get is called.”
isset($test->c);    //__isset被调用，输出“e, __isset is called.”
unset($test->d);    //__unset被调用，输出“e, __isset is called.”
$test->e(1,2,3);    //__call被调用，输出“c-1,2,3, __call is called.”
Magic::f(1,2,3);    //__callStatic被调用，输出“d-1,2,3, __callStatic is called.”
$test = clone $test; //__clone被调用，输出“__clone is called.”
echo $g = serialize($test); //__sleep被调用，输出O:5:"Magic":1:{s:7:"*demo";s:5:"magic";}
print_r(unserialize($g));   //__wakeup被调用，输出Magic Object ( [demo:protected]=> 11111[str:protected] => example ) 
echo $test;         //__toString被调用，输出__toString is called.example
$test();            //__invoke被调用，输出__invoke is called.
eval('$h='.var_export($test, true).';');  //__set_state被调用，输出__set_state is called.
var_dump($test);    //__debuinfo被调用，输出__debuginfo is called.object(Magic)#2 (0) { }
//__destruct被调用，输出“__destruct is called.”
