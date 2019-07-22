<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-14
 * Time: 下午4:36
 */
namespace Home\Services\request;
class request{

//
//$header = array('Content-type'=>'application/json',
//'token'=>'',
//'sign'=>'',
//'timestamp'=>'12123453277',//2011-06-16 13:23:30
//'accessKey'=>'',//访问的key
//'accessSecret'=>'',//
//'signatureMethod'=>'',//签名方法
//'signatureVersion'=>'',//签名的版本
//'signature'=>'',//签名
//'apiVersion'=>'',//接口服务版本号
//'requestId'=>'',//唯一请求id
//);



    /***
     * @param $url
     * @param $data
     * @return mixed
     */
    function curl_post($url, $data )
    {
        $header=array(
            'Content-Type:application/json;charset=UTF-8',
            'Content-Length:'.strlen($data),
        );

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER=>$header,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_TIMEOUT => 30
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * post 请求
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function curlPost($url , $data ){
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_TIMEOUT => 30
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }



    /**
     * curlGet请求
     * @param $url
     * @return array
     */
    public static function curlGet( $url ){
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_HEADER, 0);
//        //当请求https的数据时，会要求证书，这时候加上下面两个参数，避免ssl的证书检查
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
//
//        $data = curl_exec($curl);
//        //var_dump($data);
//        curl_close($curl);

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POST => false,
            CURLOPT_TIMEOUT => 30
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function test(){
        return 'ok';
    }

}