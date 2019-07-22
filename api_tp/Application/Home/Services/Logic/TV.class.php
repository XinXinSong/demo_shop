<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-17
 * Time: 下午4:25
 */
namespace Home\Services\Logic;
class TV{
    /***
     * 首页直播信息，当前节目+前两个+后两个
     * @param $param
     */
    public function gettv_index($param){
        if($param&&is_array($param)){
            $data=$param['result'];
            if($data){
                $time=date('Y-m-d H:i:s',time());
                $tv_index=array();
                //获取前两档直播
                $e_index=0;
                $endtime_asc=$this->sortlist($data,array('direction'=>'SORT_ASC','field'=>'formEndDate'));
                foreach ($endtime_asc as $ek=>$ev){
                    if($ev['formFrDate']<=$time&&$ev['formEndDate']>$time){
                        $e_index=$ek;
                    }
                }

                if($endtime_asc[$e_index-2]){
                    $tv_index[]=$endtime_asc[$e_index-2];
                }
                if($endtime_asc[$e_index-1]){
                    $tv_index[]=$endtime_asc[$e_index-1];
                }
                $tv_index[]=$endtime_asc[$e_index];
                //获取后两档直播
                $s_index=0;
                $starttime_asc=$this->sortlist($data,array('direction'=>'SORT_DESC','field'=>'formFrDate'));
                foreach ($starttime_asc as $sk=>$sv){
                    if($sv['formFrDate']<=$time&&$sv['formEndDate']>$time){
                        $s_index=$sk;
                    }
                }
                if($starttime_asc[$s_index+1]){
                    $tv_index[]=$starttime_asc[$s_index+1];
                }
                if($starttime_asc[$s_index+2]){
                    $tv_index[]=$starttime_asc[$s_index+2];
                }
                unset($param['result']);
                $param['result']=$tv_index;
            }
        }
        return $param;
    }



    /***
     * 为二维数组排序
     * @param $arr
     * @param $sort array('direction' => 'SORT_DESC',//排序顺序标志 ORT_DESC降序SORT_ASC 升序
     * 'field'=> 'age',//排序字段)
     */
    public function sortlist($arr,$sort){
        $arrSort = array();
        foreach($arr AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']),      $arrUsers);
        }
        return $arr;
    }
}