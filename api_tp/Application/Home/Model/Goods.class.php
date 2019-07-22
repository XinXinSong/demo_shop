<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-4-5
 * Time: 下午2:57
 */
namespace Home\Model;
class goods {
    private $goods=null;
    public function __construct()
    {
        if($this->goods==null){
            $this->goods=M('goods');
        }
    }

    /***
     * 添加
     * @param $param
     * @return false|int
     */
    public function add($param){
        if($param){
            //判断是否已存在该商品
            $is_exist= $this->goods->where(array('goodId'=>$param['goodId']))->select();
            //若存在,修改
            if($is_exist){
                $id=intval($is_exist[0]['goodid']);
                $res=true;
                if($param['name']&&$param['image']&&$param['price']){
                    $res=$this->goods->execute("update goods set name='".$param['name']."' ,image='".$param['image']."',price=".$param['price']." where goodId=".$id);

                }
                if($res){
                    $res=$id;
                }
            }else{
                //若不存在，新增
                $res=$this->goods->add(array('goodId'=>$param['goodId'],'name'=>$param['name'],'image'=>$param['image'],'price'=>$param['price']));
            }
        }
        return $res;
    }

    /***
     * 查询
     * @param $goodId
     * @return mixed
     */
    public function select($goodId){
        if($goodId){
            $data=$this->goods->where(array('goodId'=>$goodId))->select();
        }
        return $data;
    }
}