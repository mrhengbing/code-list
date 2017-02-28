<?php
/**
 * @Author: mrhengbing
 * @Email:  415671062@qq.com
 * @Create time:   2017-02-27 15:19:13
 * @Last Modified by:   mrhengbing
 * @Last Modified time: 2017-02-27 16:09:39
 * APP接口案例
 */
//http://xxx.com/responce.php?page=1&pagesize=2
header("Content-Type:text/html;charset=utf-8");

require_once("./db.class.php");
require_once("./api.class.php");
require_once("./file.class.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 10;

if(!is_numeric($page) || !is_numeric($pageSize)){
    return Api::show(401, '数据不合法');
}

$offset = ($page-1)*$pageSize;          //当前页开始行数

$sql = "select * from db_blog order by orderid desc limit ".$offset.",".$pageSize;

$cache = new File();    //实例化静态缓存对象

$data = array();        

$data = $cache->cacheData("cache".$page.'-'.$pageSize);     //将缓存内容赋给$data

/*判断缓存是否存在，若不存在，则从数据库获取数据，并缓存*/
if(!$data){
    try{
        $connect = Db::getInstance()->connect();
    }catch(Exception $e){
        return Api::show(403, "数据库连接失败！");
    }

    $result = mysql_query($sql, $connect);

    while($row = mysql_fetch_assoc($result)){
        $data[] = $row;
    } 

    /*执行缓存*/
    if($data){
        $cache->cacheData("cache".$page.'-'.$pageSize, $data, 100);
    }
}
/*返回数据*/
if($data){
    return Api::show(200, "数据返回成功！", $data);
}else{
    return Api::show(400, "数据返回失败！", $data);
}

