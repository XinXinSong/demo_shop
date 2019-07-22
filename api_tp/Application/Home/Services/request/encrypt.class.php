<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-14
 * Time: 下午4:47
 */
namespace Home\Services\request;
class encrypt{
    /***
     * oms接口加密
     */
    public static function oms_encrypt(){

    }

    /***
     * b2c接口加密
     */
    public static function b2c_encrypt($params){
        $certificate=C('CERTIFICATE.TOKEN');
//        var_dump('request:'.$params);
//        var_dump('assemble:'.  self::assemble($params));
//        echo('token:'.  $certificate);
//        var_dump('upper+token'. strtoupper(md5(self::assemble($params))).$certificate);
        $sign=strtoupper(md5(strtoupper(md5(self::assemble($params))).$certificate));
        return $sign;
    }

    /***
     * 排序
     * @param $params
     * @return null|string
     */
    static function assemble($params)
    {
        if(!is_array($params))  return null;
        ksort($params, SORT_STRING);
        $sign = '';
        foreach($params AS $key=>$val){
            if(is_null($val))   continue;
            if(is_bool($val))   $val = ($val) ? 1 : 0;
            $sign .= $key . (is_array($val) ? self::assemble($val) : $val);
        }
        return $sign;
    }
}