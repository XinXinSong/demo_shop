<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-20
 * Time: 下午2:39
 */
namespace Home\Services\Logic;
class Products{
    /**
     * 处理b2c和oms的商品详情数据
     */
    public function oper_product_b2c_oms($param_b2c,$param_oms){

        if($param_b2c&&$param_oms){
            $status='success';
            $description='';
            if($param_b2c['status']=="success"&&$param_oms['status']=='success'){
                $guiges=array();
                if($param_oms['result']&&$param_oms['result']['guige']){
                    foreach ($param_oms['result']['guige'] as $kg=>$vg){
                        $guige=array(
                            "colorId"=>$vg[0],
                            "colorName"=>$vg[1],
                            "styleId"=>$vg[2],
                            "styleName"=>$vg[3]
                        );
                        $guiges[$kg]=$guige;
                    }
                }
                $param_b2c['result']['guiges']=$guiges;
            }else{
                $status='error';
                $description="数据为空";
                $requestId=null;
            }
        }else{
            $status='fail';
            $description="获取失败";
            $requestId=null;
        }
        if($status!='success'){
            return array("status"=>$status,"description"=>$description,"requestId"=>$requestId);
        }else{
            return $param_b2c;
        }
    }


    /***
     * 计算库存总数
     * @param $param
     * @return int
     */
    public function get_store($data){
        $count=0;
        if($data){
            $data=json_decode($data,true);
            if($data['status']=='success'){
                $param=$data['result'];
                foreach ($param as $item){
                    $count+=intval($item['qty']);
                }
            }
        }
        return $count;
    }

    /***
     * 将库存和赠品结合展示
     * @param $store
     * @param $gift
     */
    public function combine_store_gift($storecount,$gift){
        if($gift){
            $gift_data=array();
            foreach ($gift as $gv){
                $gv=json_decode($gv,true);
                if($gv['status']=='success'){
                    if($gv['result']){
                        $gift_data[]=$gv['result'];
                    }
                }
            }
        }
        if($gift_data){
            $data=array(
                'status'=>'success',
                'description'=>'查询成功',
                'requestId'=>null,
                'result'=>array(
                    'store'=>$storecount,
                    'gift'=>$gift_data[0]
                )
            );
        }else{
            $data=array(
                'status'=>$gift['status'],
                'description'=>$gift['description'],
                'requestId'=>null,
                'result'=>array(
                    'store'=>$storecount,
                    'gift'=>null
                )
            );
        }
        return $data;
    }

}