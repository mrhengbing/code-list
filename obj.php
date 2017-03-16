<?php
/**
 * @Author: mrhengbing
 * @Create time:   2017-03-16 15:38:34
 * @Last Modified by:   mrhengbing
 * @Last Modified time: 2017-03-16 22:38:16
 * @Email:  415671062@qq.com
 * @---------PHP面向对象的一些技巧----------------
 */
//Per-Class常量
/*class Math {
	const pi = 3.1415926;
}
echo Math::pi;*/

//静态方法
/*class Math {
	const pi = 3.1415926;

	static function squared($input)
	{
		return $input*$input;
	}
}
Math::squared(9);*/

//延迟静态绑定
/*class A {
	public static function who()
	{
		echo __CLASS__;
	}
	public static function test()
	{
		static::who();
	}
}

class B extends A {
	public static function who()
	{
		echo __CLASS__;
	}
}

B::test();*/
/*
class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        self::who();
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

B::test();*/

/*class A {
    public static function foo() {
        static::who();
    }

    public static function who() {
        echo __CLASS__."\n";
    }
}

class B extends A {
    public static function test() {
        A::foo();
        parent::foo();
        self::foo();
    }

    public static function who() {
        echo __CLASS__."\n";
    }
}
class C extends B {
    public static function who() {
        echo __CLASS__."\n";
    }
}

C::test();*/
//__call()重载
/*
class Test {
	public function __call($method, $p)
	{
		if($method = "display"){
			if(is_object($p[0]))
			{
				echo $method." object";
			}
			else if(is_array($p[0]))
			{	print_r($p);
				echo $method." array";
			}
			else if(is_numeric($p[0]))
			{
				echo $method." number";
			}
			else if(is_string($p[0]))
			{
				echo $method." string";
			}
			else
			{
				echo $method.' others';
			}
		}
		
	}
}

$t = new Test;
$t->demo(array('a','b'));
$t->display('11');*/

//__autoload()方法
/*function __autoload($name){
	echo $name.'.php';
}
new magic();*/

/*class myClass {
	public $a = '2';
	public $b = '3';
	public $c = '4';
}
$s = new myClass;
foreach ($s as $value) {
	echo $value.'<br>';
}
*/
/*
class Printable {
	public $testone;
	public $testtwo;
	public function __toString(){
		return (var_export($this, TRUE));
	}
}

$p = new Printable;
echo $p;*/

//反射API，获取某个文件中的一个类的详细内容
/*require_once("magic.php");
$class = new ReflectionClass('Magic');
echo '<pre>'.$class.'</pre>';*/