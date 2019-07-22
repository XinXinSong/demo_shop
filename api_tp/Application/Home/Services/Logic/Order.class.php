<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-21
 * Time: 下午3:29
 */
namespace Home\Services\Logic;
class Order{

    /***
     * 生成订单号
     */
    public function get_orderno(){
        $i = rand(0,99999);
        if(99999==$i){
            $i=0;
        }
        $i++;
        $order_id = date('ymdHi').str_pad($i,5,'0',STR_PAD_LEFT);
        return $order_id;
    }

}