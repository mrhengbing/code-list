<?php
/**
 * 让crontab定时执行的脚本程序  /5 * * * * /usr/bin/php /data/www/app/cron.php
**/

require_once('./db.class.php');
require_once('./file.class.php');

$sql = "select * from db_blog order by orderid desc";
try {
	$connect = Db::getInstance()->connect();
} catch(Exception $e) {
	file_put_contents('./logs/'.date('y-m-d').'.txt' , $e->getMessage());	//记录日志
	return;
}

$result = mysql_query($sql, $connect); 

$data = array();

while($row = mysql_fetch_assoc($result)) {
	$data[] = $row;
}

$file = new File();

if($data){
	$file->cacheData('cron_cahce', $data);
}else{
	file_put_contents('./logs/'.date('y-m-d') . '.txt' , "没有相关数据");
}
return;