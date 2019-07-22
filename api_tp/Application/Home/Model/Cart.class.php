<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-22
 * Time: 上午11:01
 */
namespace Home\Model;
class cart {
    private $cart=null;
    public function __construct()
    {
        if($this->cart==null){
            $this->cart=M('cart');
        }
    }
    /***
     * 添加商品到购物车
     * @param $param
     */
    public function add_cart($param){
        if($param){
            //判断是否该用户的购物车已经存在该商品
            $is_exist= $this->cart->where(array('custId'=>$param['custId'],'goodId'=>$param['goodId'],'colorId'=>$param['colorId'],'styleId'=>$param['styleId'],'status'=>0))->select();
            //若存在,数量几+1
            if($is_exist){
                $id=intval($is_exist[0]['id']);
                if($param['name']&&$param['image']&&$param['price']){
                    $res=$this->cart->execute("update cart set num=num+1,name='".$param['name']."',image='".$param['image']."',price=".$param['price']." where id=".$id);
                }else{
                    $res=$this->cart->execute("update cart set num=num+1 where id=".$id);
                }

                if($res){
                    $res=$id;
                }
            }else{
                //若不存在，新增
                $res=$this->cart->add(array('custId'=>$param['custId'],'goodId'=>$param['goodId'],'colorId'=>$param['colorId'],'styleId'=>$param['styleId'],'num'=>$param['num'],'status'=>0,'name'=>$param['name'],'price'=>$param['price'],'image'=>$param['image']));
            }
        }
        return $res;
    }

    /***
     *获取购物车列表
     * @param $custId
     */
    public function get_list($custId){
        $data=$this->cart->where(array('custId'=>$custId,'status'=>0))->select();
        return $data;
    }

    /***
     * 删除
     * @param $id
     */
    public function delete($id){
        $res=$this->cart->where(array('id'=>$id))->save(array('status'=>2));
        return $res;
    }

    /***
     * 对数量的操作
     * @param $id
     * @param $num
     * @param $type
     * @return bool|false|int
     */
    public function num($id,$num,$type){

        if($type=='reduce'){
            $cart=$this->cart->where(array('id'=>$id))->select();
            if($cart[0]){
                if($cart[0]['num']<=$num){
                    //删除
                    $res=$this->delete($id);
                }else{
                    $res=$this->cart->execute('update cart set num=num-'.$num.' where id='.$id);
                }
            }
        }else{
            $res=$this->cart->execute('update cart set num=num+'.$num.' where id='.$id);
        }
        return $res;
    }
}
