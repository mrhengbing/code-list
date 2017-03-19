<?php
/**
 * @Author: mrhengbing
 * @Create time:   2017-03-17 17:13:12
 * @Last Modified by:   mrhengbing
 * @Last Modified time: 2017-03-19 22:30:14
 * @Email:  415671062@qq.com
 */
$mem = new Memcache;   //实例化memcache对象

$mem->connect("localhost", 1121);  //建立连接

$mem->addSever("www.xxxx.com", 1121);   //添加服务器
   
$mem->add("mystr", "This is a memcache test.", MEMCACHE_COMPRESSED, 3600);  //保存字符串类型的数据

$str = $mem->get("mystr");     //取出保存的数据

echo $str.'<br>';             //输出数据

$mem->add("myarr", array("aaa", "bbb", "ccc"), MEMCACHE_COMPRESSED, 3600); //保存数组类型的数据

$mem->set("myarr", array("ddd", "eee", "fff"), MEMCACHE_COMPRESSED, 3600); 

$arr = $mem->get("myarr");   //取出保存的数据
    
print_r($arr);              //输出数据

  //  echo '<br>';
  //  echo $mem->getVersion();   //获取版本信息
