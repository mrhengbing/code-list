<?php
/**
 * APP接口返回数据方式的封装类
 */

class Api{ 

    /**
     * 多种方式输出通信数据
     * @param  string $code    状态码
     * @param  string $message 提示信息
     * @param  array  $data    返回的数据
     * @param  string $type    返回数据格式，默认为json
     * @return string
     */
    static public function show($code, $message='', $data=array(), $type="json"){

        //判断$code是否为空，是的话，就返回空
        if (empty($code)) {
            return '';
        }
        
        //判断客户端是否传进$type，没有传进来就默认json 
        $type = isset($_GET['format']) ? $_GET['format'] : "json";

        $result = array(
            'code'    => $code,
            'message' => $message,
            'result'  => $data
        );

        if ($type == 'json'){

            self::json($code, $message, $data);

        }else if($type == 'xml'){

            self::xml($code, $message, $data);

        }else if($type == 'array'){
            //数组形式，只是给客户端开发人员调试用的
            var_dump($result);
        }else{
            //TODO 其他方式，预留后期根据需求开发
        }

        exit;
    }

    /**
     * 按json方式输出通信数据
     * @param  string $code    状态码
     * @param  string $message 提示信息
     * @param  array  $data    返回的数据
     * @param  int    $num     数据总条数
     * @return string
     */
    static public function json($code, $message='', $data=array()){
        
        //判断$code是否为空，是的话，就返回空
        if (empty($code)) {
            return '';
        }

        $result = array(
            'code'    => $code,
            'message' => $message,
            'result'  => $data
        );
        
        echo json_encode($result);
        exit();
    }
    
    /**
     * 按照xml方式输出通信数据
     * @param  string $code    状态码
     * @param  string $message 提示信息
     * @param  array  $data    返回数据
     * @return string
     */
    static public function xml($code, $message='', $data = array()){
        
        //判断$code是否为空，是的话，就返回空
        if (empty($code)) {
            return '';
        }

        $result = array(
            'code'    => $code,
            'message' => $message,
            'result'  => $data
        );

        header("Content-Type:text/xml");
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .="<root>\n";
        $xml .= self::xmlData($result);
        $xml .="</root>";
        
        echo $xml;
        exit;
    }
    
    /**
     * 循环遍历传进来的数据，封装成xml格式
     * @param  [type] string
     * @return [type] string
     */
    static public function xmlData($data){

        $xml = $attr = "";

        foreach ($data as $key => $value){

            if (is_numeric($key)){
                $attr = "id='{$key}'";
                $key  = "item";
            }

            $xml .= "<{$key} {$attr}>";
            $xml .= is_array($value) ? self::xmlData($value) : $value;
            $xml .= "</{$key}>\n";
        }

        return $xml;
    }
    
}
