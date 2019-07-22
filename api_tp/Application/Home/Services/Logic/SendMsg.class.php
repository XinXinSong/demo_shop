<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-30
 * Time: 下午1:01
 */
namespace Home\Services\Logic;
class SendMsg{

    /***
     * 发送内容
     * @param $type
     * @return string
     */
    public function sms_content($type,$code){
        switch ($type){
            //注册
            case '1':
                $content='您注册的验证码：'.$code.',请您在2分钟之内填写，[环球购物]';
                break;
            //忘记密码
            case '2':
                $content='您修改密码操作的验证码：'.$code.',请您在2分钟之内填写，[环球购物]';
                break;
            default:
                break;
        }
        return $content;
    }

    /***
     * 生成4位随机验证码
     * @param int $length
     * @return int
     */
    public function code($length = 4){
        $min = pow(10 , ($length - 1));
        $max = pow(10, $length) - 1;
        return rand($min, $max);
    }
    /**
     * 环球短信通道
     * 发短信
     * - 还没合同，不可使用
     * @static
     * @param string $mobile 手机号码
     * @param string $msg_content 短信内容
     * @param string $corp_msg_id 为了分析，分析代码
     * @return mixed 发短信结果
     */
    public function SendSms($mobile, $msg_content)
    {
        $flag = 0;
        $params='';
        $pwd=strtoupper(md5('SDK-BBX-010-19006c-6[5d-['));//SDK-BBX--aab#-
        //echo $pwd;
        //exit;
        //要post的数据
        $argv = array(
            'sn'=>'SDK-BBX-010-19006', //提供的账号SDK-BBX-
            'pwd'=>$pwd, //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
            'mobile'=>$mobile,//手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
            'content'=>iconv('utf-8','gb2312//ignore',$msg_content),//短信内容
            'ext'=>'',
            'rrid'=>'',//默认空 如果空返回系统生成的标识串 如果传值保证值唯一 成功则返回传入的值
            'stime'=>''//定时时间 格式为2011-6-29 11:09:21
        );

        //构造要post的字符串

        foreach ($argv as $key=>$value) {
            if ($flag!=0) {
                $params .= "&";
                $flag = 1;
            }
            $params= $params.$key."=";
            $params.= urlencode($value);
            $flag = 1;
        }
        //echo $params;

        $length = strlen($params);
        //创建socket连接
        $fp = fsockopen("sdk2.zucp.net",8060,$errno,$errstr,10) or exit($errstr."--->".$errno);
        //构造post请求的头
        $header = "POST /z_mdsmssend.aspx HTTP/1.1\r\n";
        $header .= "Host:sdk2.zucp.net:8060\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: ".$length."\r\n";
        $header .= "Connection: Close\r\n\r\n";
        //添加post的字符串
        $header .= $params."\r\n";
        //发送post的数据
        fputs($fp,$header);
        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
            if ($inheader == 0) {
                // echo $line;
            }
        }
        ;
        //echo $msg_content;
        fclose($fp);

        return $line;
    }
//$mobile = "13231231231";
//$vcode = "您短信的验证码：$vcode,请您在2分钟之内填写，[环球购物]";
//SendSms($mobile,$vcode);
}