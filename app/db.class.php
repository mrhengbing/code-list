<?php
/**
 * @Author: mrhengbing
 * @Email:  415671062@qq.com
 * @Create time:   2017-02-28 10:46:15
 * @Last Modified by:   mrhengbing
 * @Last Modified time: 2017-02-28 12:03:16
 * 这是一个单列模式连接数据库类
 */
class Db{

    static private $_instance;      //用来保存实例的变量

    static private $_connectDb;     //用来赋给数据库连接资源或对象的变量

    /*数据库配置*/
    private $_dbConfig = array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'database' => 'blog',
    );

    private function __construct(){

    }

    /**
     * 实例化对象
     * @return [type] [description]
     */
    static public function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }


    /**
     * mysql_connect方式连接数据库
     * @return [object]
     */
    public function connect(){
        if(!self::$_connectDb) {

            self::$_connectDb = @mysql_connect($this->_dbConfig['host'], $this->_dbConfig['user'], $this->_dbConfig['password']);   

            if(!self::$_connectDb) {
                throw new Exception('Connect failed ' . mysql_error());
                //die('mysql connect error' . mysql_error());
            }
            
            mysql_select_db($this->_dbConfig['database'], self::$_connectDb);
            mysql_query("set names UTF8", self::$_connectDb);
        }
        return self::$_connectDb;
    }

    /**
     * mysqli面向对象方式连接数据库
     * @return [type] [description]
     */
    public function connectMysqli(){
        if(!self::$_connectDb) {
            self::$_connectDb = new mysqli($this->_dbConfig['host'], $this->_dbConfig['user'], $this->_dbConfig['password'], $this->_dbConfig['database']);

            if(mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
        }
        return self::$_connectDb;
    }

    public function connectPdo(){

        $dsn = "mysql:dbname=".$this->_dbConfig['database'].";host=".$this->_dbConfig['host'];

        if(!self::$_connectDb) {
            try{
                self::$_connectDb = new PDO($dsn, $this->_dbConfig['user'], $this->_dbConfig['password']);
            }catch(PDOException $e){
                echo 'Connect failed ' .$e->getMessage();
            }     
        }

        return self::$_connectDb;
    }

}

/*
$connect = Db::getInstance()->connect();

$sql = "select * from user";
$result = mysql_query($sql, $connect);
$num_rows = mysql_num_rows($result);
echo $num_rows;
mysql_close($connect);*/
/*
$connect = Db::getInstance()->connectMysqli();

$sql = "select * from user";

$result = $connect->query($sql);

if($result->num_rows > 0){
    $num_rows = $result->num_rows;

    $row = $result->fetch_assoc();

    echo $num_rows;
    print_r($row);
}

$connect->close();*/

/*
$connect = Db::getInstance()->connectPdo();

$sql = "select * from user";

$result = $connect->query($sql);

foreach($result as $row){
    print_r($row);
}
*/