<?php
/**
 * 这是一个静态缓存类
 */
class File{

    private $_dir;

    const EXT = '.txt';         //定义常量，指定缓存文件后缀

    public function __construct(){
        $this->_dir = dirname(__FILE__).'./cache/';
    }

    public function cacheData($key, $value="", $cacheTime=0){
        $filename = $this->_dir.$key.self::EXT;

        /*将value值写入缓存*/
        if($value !== '') { 
            /*$value为null时，删除缓存文件*/
            if(is_null($value)) {
                return @unlink($filename);
            }

            $dir = dirname($filename);

            /*如果目录不存在，则新建目录*/
            if(!is_dir($dir)) {
                mkdir($dir, 0777);
            }

            $cacheTime = sprintf('%011d', $cacheTime);

            /*生成缓存*/
            return file_put_contents($filename, $cacheTime.json_encode($value));
        }

        if(!is_file($filename)) {
            return FALSE;
        }

        $contents = file_get_contents($filename);       //获取所有缓存内容

        $cacheTime = (int)substr($contents, 0, 11);     //截取设定的缓存时间

        $value = substr($contents, 11);                 //截取需要的缓存内容
        
        /*判断缓存时间是否到期，若是，则删除缓存文件*/
        if($cacheTime != 0 && (($cacheTime + filemtime($filename)) < time())){
            @unlink($filename);
            return FALSE;
        }

        return json_decode($value, true);     
    }
}

