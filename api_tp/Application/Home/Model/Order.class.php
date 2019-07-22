<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-28
 * Time: 下午3:26
 */
namespace Home\Model;
use Think\Db;

class Order{
    private $order=null;
    private $order_item=null;
    public function __construct()
    {
        if($this->order==null){
            $this->order=M('order');
        }
        if($this->order_item==null){
            $this->order_item=M('order_item');
        }
    }

    /***
     * @param $custId
     * @param $orderitem
     * @return mixed
     */
    public function creat($custId,$orderitem){
        if($orderitem&&$custId){
            //创建订单号
            $order_logic=new \Home\Services\Logic\Order();
            $order_bn=$order_logic->get_orderno();


            $this->order->startTrans();
            $order_add=$this->order->add(array('orderid'=>$order_bn,'custid'=>$custId,'ordertime'=>date('Y-m-d H:i:s',time())));

            if($order_add){
                $orderitem_add=true;
                foreach ($orderitem as $item){
                    $orderitem_add=$this->order_item->add(array('orderid'=>$order_bn,'goodid'=>$item['goodId'],'colorid'=>$item['colorId'],'styleid'=>$item['styleId'],'num'=>$item['num']));

                }
                $res=$order_bn;
            }
            if(!$order_add||!$orderitem_add){

                $this->order->rollback();
            }
            $this->order->commit();

        }else{
            return 0;
        }
        return $res;
    }
}
