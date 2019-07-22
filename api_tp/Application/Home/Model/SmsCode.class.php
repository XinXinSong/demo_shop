<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-30
 * Time: 下午2:06
 */
namespace Home\Model;
class SmsCode{
    private $smscode=null;
    public function __construct()
    {
        if($this->smscode==null){
            $this->smscode=M('smscode');
        }
    }


    /***
     * 增加
     * @param $param
     * @return mixed
     */
    public function add($param){
        if($param){
            $res=$this->smscode->add(array('mobile'=>$param['mobile'],'code'=>$param['code'],'createdt'=>date('Y-m-d H:i:s',time()),'status'=>0));
        }
        return $res;
    }


    /***
     * 验证码校验
     * @param $mobile
     * @param $code
     * @return mixed
     */
    public function test($mobile,$code){
        $data=$this->smscode->query('select * from smscode where mobile='.$mobile.' and code='.$code.' and status=0 order by createdt desc limit 0,1');
        if($data){
            $createdt=$data[0]['createdt'];
            $time_check=$this->checkTime(date('Y-m-d H:i:s',time()),$createdt);
            if($time_check){
                $res=array(
                    "status"=>'success',"description"=>'验证成功',"requestId"=>null,"result"=>''
                );
            }else{
                $res=array(
                    "status"=>'fail',"description"=>'验证码过期，请重新获取',"requestId"=>null,"result"=>''
                );
            }
            $this->smscode->execute("update smscode set updatedt='".date('Y-m-d H:i:s',time())."' , status=1 where id=".$data[0]['id']);
        }else{
            $res=array(
                "status"=>'fail',"description"=>'验证码错误',"requestId"=>null,"result"=>''
            );
        }
        return $res;
    }




    /***
     * // 验证验证码时间是否过期
     * @param $nowTimeStr
     * @param $smsCodeTimeStr
     * @return bool
     */
    public function checkTime($nowTimeStr,$smsCodeTimeStr){
        $nowTime = strtotime($nowTimeStr);
        $smsCodeTime = strtotime($smsCodeTimeStr);
        $period = floor(($nowTime-$smsCodeTime)%86400/60); //120s
        if($period>=0 && $period<=C('SMSCODETIME')){
            return true;
        }else{
            return false;
        }
    }

}