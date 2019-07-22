<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-14
 * Time: 下午4:27
 */

namespace Home\Controller;
use Home\Model\Cart;
use Home\Model\Order;
use Home\Model\SmsCode;
use Home\Model\Goods;
use Home\Services\Logic\Products;
use Home\Services\Logic\SendMsg;
use Home\Services\Logic\SiteNo;
use Home\Services\Logic\TV;
use Think\Controller;
use Think\Model;

class PageIndexController extends Controller
{
    private $b2c_host=null;
    private $oms_host=null;
    private $oms_host_customer=null;
    private $oms_host_tv=null;
    private $oms_host_order=null;
    private $request=null;
    private $encrypt=null;
    public function __construct()
    {
        parent::__construct();
        $this->oms_host=C('OMS_HOST');
        $this->oms_host_customer=C('OMS_HOST_CUSTOMER');
        $this->oms_host_tv=C('OMS_HOST_TV');
        $this->oms_host_order=C('OMS_HOST_ORDER');
        $this->b2c_host=C('B2C_HOST');
        $this->request=new \Home\Services\request\request();
        $this->encrypt=new \Home\Services\request\encrypt();
    }

    public function test(){
//        $request=new \Home\Services\request\request();
//        $msg=$request::test();
//        echo $msg;
//        echo $this->b2c_host;
        //echo 'ok ';
        $this->success('https://www.baidu.com/');
    }

    /***
     * 入口
     */
    public function  Index($param=null){

        $into=$_REQUEST['into'];
        if($into=='OMS'){
            $data=$this->Index_OMS();
        }else if($into=='B2C'){
            $data=$this->Index_B2C();
        }else{
            $method=$_REQUEST['method'];
            switch ($method){
                //首页直播信息
                case 'gettv_index':
                    //$tv_index=$this->Index_OMS(C('OMS_INTERFACE_TV'));
                    //测试数据
                    $tv_index=array(
                        "status"=> "success",
                        "description"=> "",
                        "requestId"=> null,
                        "result"=>array(
                            array(
                                "soId"=> 0,
                                "formId"=> 1000791,
                                "formFrDate"=> date('Y-m-d H:i:s',strtotime("-165 minute")),
                                "formEndDate"=> date('Y-m-d H:i:s',strtotime("-125 minute")),
                                "goodId"=>100049,
                                "goodNm"=> "HealthMic韩国多功能搅拌器1",
                                "soNm"=> "GHS-全国频道",
                                "formCd"=> "30",
                                "brdPrc"=> 1280,
                                "formGoodMis"=> 30
                            ),
                            array(
                                "soId"=> 0,
                                "formId"=> 1000791,
                                "formFrDate"=> date('Y-m-d H:i:s',strtotime("-85 minute")),
                                "formEndDate"=> date('Y-m-d H:i:s',strtotime("-45 minute")),
                                "goodId"=>100049,
                                "goodNm"=> "HealthMic韩国多功能搅拌器2",
                                "soNm"=> "GHS-全国频道",
                                "formCd"=> "30",
                                "brdPrc"=> 1280,
                                "formGoodMis"=> 30
                            ),
                            array(
                                "soId"=> 0,
                                "formId"=> 1000791,
                                "formFrDate"=> date('Y-m-d H:i:s',strtotime("-5 minute")),
                                "formEndDate"=> date('Y-m-d H:i:s',strtotime("35 minute")),
                                "goodId"=>100049,
                                "goodNm"=> "HealthMic韩国多功能搅拌器3",
                                "soNm"=> "GHS-全国频道",
                                "formCd"=> "30",
                                "brdPrc"=> 1280,
                                "formGoodMis"=> 30
                            ),
                            array(
                                "soId"=> 0,
                                "formId"=> 1000791,
                                "formFrDate"=> date('Y-m-d H:i:s',strtotime("75 minute")),
                                "formEndDate"=> date('Y-m-d H:i:s',strtotime("115 minute")),
                                "goodId"=>100049,
                                "goodNm"=> "HealthMic韩国多功能搅拌器4",
                                "soNm"=> "GHS-全国频道",
                                "formCd"=> "30",
                                "brdPrc"=> 1280,
                                "formGoodMis"=> 30
                            ),
                            array(
                                "soId"=> 0,
                                "formId"=> 1000791,
                                "formFrDate"=> date('Y-m-d H:i:s',strtotime("155 minute")),
                                "formEndDate"=> date('Y-m-d H:i:s',strtotime("195 minute")),
                                "goodId"=>100049,
                                "goodNm"=> "HealthMic韩国多功能搅拌器5",
                                "soNm"=> "GHS-全国频道",
                                "formCd"=> "30",
                                "brdPrc"=> 1280,
                                "formGoodMis"=> 30
                            ),
                        )

                    );
                    $tv_logic=new \Home\Services\Logic\TV();
                    $data=$tv_logic->gettv_index($tv_index);
                    $tv_index_result=$this->addimage($data['result']);
                    unset($data['result']);
                    $data['result']=$tv_index_result;
                    $data=json_encode($data);
                    break;
                //获取商品详情
                case 'get_productDetail':
                    if($_REQUEST['goodId']||$_REQUEST['sku']){
                        $sku=$_REQUEST['goodId']?$_REQUEST['goodId']:$_REQUEST['sku'];
                        $data=$this->get_goods($sku);
                    }else{
                        $data=array(
                            "status"=>'fail',"description"=>'失败',"requestId"=>null
                        );
                    }
                    $data=json_encode($data);
                    break;
                //获取库存及赠品
                case 'get_product_store_promotion':

                    $request_store=array();
                    if($_REQUEST['goodId']){
                        $request_store['goodId']=$_REQUEST['goodId'];
                    }else{
                        $data=array(
                            "status"=>'error',"description"=>'丢失goodId',"requestId"=>null
                        );
                    }
                    if($_REQUEST['colorId']){
                        $request_store['colorId']= intval($_REQUEST['colorId']);
                    }else{
                        $request_store['colorId']=0;
                    }
                    if($_REQUEST['styleId']){
                        $request_store['styleId']=intval($_REQUEST['styleId']);
                    }else{
                        $request_store['styleId']=0;
                    }
                    //查询库存列表
                    $store=$this->Index_OMS(C('B2C_PRODUCTSTORE'),$request_store);
                    $proguct_Logic=new Products();
                    $store_count=$proguct_Logic->get_store($store);

                    $request_gift=array();
                    $request_gift['goodId']=$_REQUEST['goodId'];
                    if($_REQUEST['custLvl']){
                        $request_gift['custLvl']=$_REQUEST['custLvl'];
                    }
                    if($_REQUEST['lrgnCd']){
                        $request_gift['lrgnCd']=$_REQUEST['lrgnCd'];
                    }
                    if($_REQUEST['mrgnCd']){
                        $request_gift['mrgnCd']=$_REQUEST['mrgnCd'];
                    }
                    if($_REQUEST['srgnCd']){
                        $request_gift['srgnCd']=$_REQUEST['srgnCd'];
                    }
                    $site_Logic=new SiteNo();
                    //通过前端定位，显示当前库位的赠品
                    $gift_arr=array();
                    $siteNo_list=$site_Logic->GetSiteNoById($_REQUEST['regionId']?$_REQUEST['regionId']:'110000');
                    foreach ($siteNo_list as $site_no) {
                        $request_gift['siteNo']=$site_no;
                        $gift=$this->Index_OMS(C('B2C_PRODUCTPGIFT'),$request_gift);
                        $gift_arr[]=$gift;
                    }
                    $data=$proguct_Logic->combine_store_gift($store_count,$gift_arr);
                    $data=json_encode($data);
                    break;
                //添加商品到购物车
                case 'add_cart':
                    $cart=new Cart();
                    $request=array();
                    if($_REQUEST['custId']){
                        $request['custId']=intval($_REQUEST['custId']);
                    }else{
                        $data=array(
                            "status"=>'fail',"description"=>'请填写客代号',"requestId"=>null
                        );
                        break;
                    }
                    if($_REQUEST['goodId']){
                        $goodId=$_REQUEST['goodId'][0]=="9"?substr($_REQUEST['goodId'],1,strlen($_REQUEST['goodId'])-1):$_REQUEST['goodId'];
                        $request['goodId']=$goodId;

                    }else{
                        $data=array(
                            "status"=>'fail',"description"=>'请填写商品号',"requestId"=>null
                        );
                        break;
                    }
                    if($_REQUEST['price']){
                        //$request['price']=intval($_REQUEST['price']);
                    }
                    if($_REQUEST['name']){
                        $request['name']=$_REQUEST['name'];

                    }
                    if($_REQUEST['colorId']){
                        $request['colorId']= intval($_REQUEST['colorId']);
                    }else{
                        $request['colorId']=0;
                    }
                    if($_REQUEST['styleId']){
                        $request['styleId']=intval($_REQUEST['styleId']);
                    }else{
                        $request['styleId']=0;
                    }
                    if($_REQUEST['num']){
                        $request['num']=intval($_REQUEST['num']);
                    }else{
                        $request['num']=1;
                    }
                    if($_REQUEST['image']){
                        $request['image']=$_REQUEST['image'];
                    }
                    if(!$request['name']){
                        //先去库里查
                        $goods=new Goods();
                        $goods_item=$goods->select($request['goodId']);
                        if(!$goods_item){
                            //当库里查不到去访问接口
                            $this->get_goods($request['goodId']);
                            $goods_item=$goods->select($request['goodId']);
                        }
                        $request['name']=$goods_item[0]['name'];
                        $request['price']=$goods_item[0]['price'];
                        $request['image']=$goods_item[0]['image'];
                    }
                    $res=$cart->add_cart($request);
                    if($res){
                        $data=array(
                            "status"=>'success',"description"=>'',"requestId"=>null,"result"=>array("addId"=>$res)
                        );
                    }else{
                        $data=array(
                            "status"=>'error',"description"=>'操作失败',"requestId"=>null
                        );
                    }
                    $data=json_encode($data);
                    break;
                //获取购物车列表
                case 'get_cart':
                    $custId=$_REQUEST['custId'];
                    if(!$custId){
                        $data=array(
                            "status"=>'fail',"description"=>'请填写客代号',"requestId"=>null
                        );
                        break;
                    }else{
                        $cart=new Cart();
                        $cart_data=$cart->get_list($custId);
                        $data=array(
                            "status"=>'success',
                            "description"=>'查询成功',
                            "requestId"=>null,
                            "result"=>$cart_data
                        );
                    }
                    $data=json_encode($data);
                    break;
                //删除购物车
                case 'del_cart':
                    $id=$_REQUEST['id'];
                    if(!$id){
                        $data=array(
                            "status"=>'fail',"description"=>'请填写客id',"requestId"=>null
                        );
                        break;
                    }else{
                        $cart=new Cart();
                        $cart_res=$cart->delete($id);
                        $data=array(
                            "status"=>'success',
                            "description"=>'删除成功',
                            "requestId"=>null,
                            "result"=>$cart_res
                        );
                    }
                    $data=json_encode($data);
                    break;
                //操作数量
                case 'oper_num':
                    $id=$_REQUEST['id'];
                    if(!$id){
                        $data=array(
                            "status"=>'fail',"description"=>'请填写客id',"requestId"=>null
                        );
                        break;
                    }
                    $num=intval( $_REQUEST['num']);
                    $type=$_REQUEST['type'];
                    $cart=new Cart();
                    $res=$cart->num($id,$num,$type);
                    $data=array(
                        "status"=>'success',"description"=>'修改成功',"requestId"=>null,"result"=>$res
                    );
                    $data=json_encode($data);
                    break;
                //创建订单
                case 'create_order':
                    $custId=$_REQUEST['custId'];
                    $item=$_REQUEST['item'];
//                    var_dump($item);
//                    exit();
                    $order=new Order();
                    $res=$order->creat($custId,$item);
                    if($res){
                        $data= array(
                            "status"=>'success',"description"=>'生成成功',"requestId"=>null,"result"=>$res
                        );
                    }else{
                        $data= array(
                        "status"=>'fail',"description"=>'生成失败',"requestId"=>null,"result"=>''
                    );
                    }
                    $data=json_encode($data);
                    //var_dump($item);
                    break;
                //注册用户第一步（验证手机号是否已注册）
                case 'register1':
                    $mobile=trim($_REQUEST['mobile']);
                    if(!$mobile){
                        $data=array(
                            "status"=>'fail',"description"=>'手机号码为空',"requestId"=>null,"result"=>''
                        );
                        break;
                    }
                    $request=array('hpTeld'=>substr($mobile,0,3),'hpTelh'=>substr($mobile,3,4),'hpTeln'=>substr($mobile,7,4),'oms_hostBn'=>'customer');
                    $res=$this->Index_OMS(C('OMS_CUSTBYPHONENUM'),$request);
                    $res=json_decode($res,true);
                    if($res&&$res['status']=='success'){
                        $data=array(
                            "status"=>'fail',"description"=>'该手机号码已被注册，请去登录',"requestId"=>null,"result"=>''
                        );
                    }else{
                        $data=array(
                            "status"=>'success',"description"=>'',"requestId"=>null,"result"=>''
                        );
                    }
                    $data=json_encode($data);
                    break;
                //注册用户第二步（发送短信验证码）
                case 'register2':
                    $mobile=$_REQUEST['mobile'];
                    if(!$mobile){
                        $data=array(
                            "status"=>'fail',"description"=>'手机号码为空',"requestId"=>null,"result"=>''
                        );
                        break;
                    }
                    $sendmsg=new SendMsg();
                    $code=$sendmsg->code(4);
                    $content=$sendmsg->sms_content(1,$code);
                    $res=$sendmsg->SendSms($mobile,$content);
                   // $res=true;
                    if($res){
                        $smscode=new SmsCode();
                        $add=$smscode->add(array('mobile'=>$mobile,'code'=>$code));
                        $data=array(
                            "status"=>'success',"description"=>'',"requestId"=>null,"result"=>''
                        );
                    }else{
                        $data=array(
                            "status"=>'fail',"description"=>'短信验证码发送失败',"requestId"=>null,"result"=>''
                        );
                    }
                    $data=json_encode($data);
                    break;
                //注册用户第三步（验证验证码）
                case 'register3':
                    $mobile=$_REQUEST['mobile'];
                    $code=$_REQUEST['code'];
                    if($mobile&&$code&&is_numeric($mobile)&&is_numeric($code)){
                        $smscode=new SmsCode();
                        $data=$smscode->test($mobile,$code);
                    }else{
                        $data=array(
                            "status"=>'fail',"description"=>'请填写正确的手机号和验证码',"requestId"=>null,"result"=>''
                        );
                    }
                    $data=json_encode($data);
                    break;
                //修改密码
                case 'editpassword':
                    $password_o=$_REQUEST['password_o'];
                    $password_n=$_REQUEST['password_n'];
                    $custId=$_REQUEST['custNo'];
                    if(!$password_n||!$password_o||!$custId){
                        $data=array(
                            "status"=>'fail',"description"=>'请填写完整',"requestId"=>null,"result"=>''
                        );
                        $data=json_encode($data);
                        break;
                    }
                    $login_params=array('oms_hostBn'=>$_REQUEST['oms_hostBn'],'custNo'=>$custId,'password'=>$password_o);
                    //验证旧密码是否正确
                    $data1=$this->Index_OMS(C('OMS_LOGIN'),$login_params);
                    if($data1){
                        $data1=json_decode($data1,true);
                        if(strtolower($data1['status'])=='success'){
                            //验证通过，修改密码
                            $editpassword_params=array('custNo'=>$custId,'password'=>$password_n,'oms_hostBn'=>$_REQUEST['oms_hostBn']);
                            $data2=$this->Index_OMS(C('OMS_EDITPASSWORD'),$editpassword_params);
                            $data=$data2;
                        }else{
                            $data=array( "status"=>'fail',"description"=>'旧密码错误',"requestId"=>null,"result"=>'');
                            $data=json_encode($data);
                        }
                    }else{
                        $data=array( "status"=>'fail',"description"=>'旧密码错误',"requestId"=>null,"result"=>'');
                        $data=json_encode($data);
                    }
                    break;
                default:
                    break;
            }
        }
        if(isset($_GET['provisional'])&&!empty($_GET['provisional'])){
            echo $_GET['provisional'].'('.($data).')';
        }else{
            echo ($data);
        }
    }


    /***
     * b2c入口：公共参数method,member_id,version,direct=true
     */
    public function Index_B2C($method=null,$request=null){

        if(!$request){
            $request=array_merge($_POST,$_GET);
        }
        if(!$request['direct']){
            $request['direct']="true";
        }
        unset($request['into']);
        unset($request['provisional']);
        $sign=$this->encrypt->b2c_encrypt($request);
        $requestArr=array();
        $requestArr[]="sign=".$sign;

        foreach ($request as $kr=>$vr){
            if($kr!='into'&&$kr!='provisional'){
                if($kr=='method'&&$method){
                    $requestArr[]=$kr.'='.$method;
                }else{
                    $requestArr[$kr]=$kr.'='.$vr;
                }
            }
        }
        $requestStr=implode('&',$requestArr);
        $url=$this->b2c_host.'?'.$requestStr;
        $data=$this->request->curlGet($url);
        return $this->format_data($data);
    }


    /***
     * oms入口:参数method地址栏传参，其他参数post传参
     */
    public function Index_OMS($method=null,$request=null){
        $urlEx='';
        //判断接口地址
        $oms_hostBn=$request['oms_hostBn']?$request['oms_hostBn']:$_REQUEST['oms_hostBn'];
        switch ($oms_hostBn){
            case 'customer':
                $urlEx=$this->oms_host_customer;
                break;
            case 'tv':
                $urlEx=$this->oms_host_tv;
                break;
            case 'order':
                $urlEx=$this->oms_host_order;
                break;
            default:
                $urlEx=$this->oms_host;
                break;
        }
        if(!$request){
            $request=array_merge($_POST,$_GET);
        }
        if(!$method){
            $method=$_REQUEST['method'];
        }
        unset($request['into']);
        unset($request['provisional']);
        $method=str_replace('.','/',$method);
        $url=$urlEx.$method;
        $requestArr=array();
        foreach($request as $k=>$v){
            if($k!='method'&&$k!='into'&&$k!='oms_hostBn'&&$k!='provisional'){
                $requestArr[$k]=$v;
            }
        }
        $data=$this->request->curl_post($url,json_encode($requestArr));
        return $data;
    }

    /***
     * 为直播加图片和价格(从b2c取图片)
     * @param $param
     */
    public function addimage($param){
        foreach ($param as &$v){
            $res=$this->Index_B2C(C('B2C_PRODUCTDETAIL'),array("method"=>C('B2C_PRODUCTDETAIL'),"sku"=>'9'.$v['goodId']));
            $res=json_decode($res,true);
            if($res['result']&&$res['result']['product_img']){
                $v['image']=$res['result']['product_img'];
                $v['price']=$res['result']['price'];
                $v['marked_price']=$res['result']['marked_price'];
            }else{
                $v['image']=C('BASE_IMG');
            }
            //$v['image']='http://172.17.0.1:16080/public/app/desktop/statics/login.png';
        }
        return $param;
    }

    /***
     * 整理b2c接口返回的数据格式（以oms为准）
     */
    public function format_data($data_b2c){
        $data_format=array();
        if($data_b2c){
            $data_b2c=json_decode($data_b2c,true);
            if($data_b2c['is_https']==0&&$data_b2c['rsp']=='succ'){
                $data_format['status']='success';
                $data_format['description']=$data_b2c['res'];
                $data_format['requestId']=null;
                foreach ($data_b2c['data'] as $k=>$v){
                    if($k!='status'&&$k!='message'&&$k!='returndata'){
                        $data_format[$k]=$v;
                    }
                }
//                $data_format['result']=$return_data;
                $data_format['result']=$data_b2c['data']['returndata'];
            }else{
                $data_format['status']='error';
                $data_format['description']=$data_b2c['res'];
                $data_format['requestId']=null;
                $data_format['result']='';
            }
        }else{
            $data_format['status']='fail';
            $data_format['description']='not found';
            $data_format['requestId']=null;
            $data_format['result']='';
        }
        return json_encode($data_format);
    }

    /***
     * 结合oms和b2c获取商品详情
     * @param $sku
     * @return array
     */
    public function get_goods($sku){
        if($sku&&$sku=strval($sku)){
            $sku_b2c=$sku[0]=="9"?$sku:"9".$sku;
            $sku_oms=$sku[0]=="9"?substr($sku,1,strlen($sku)-1):$sku;
            $data_b2c=$this->Index_B2C(C('B2C_PRODUCTDETAIL'),array("sku"=>$sku_b2c,"method"=>C('B2C_PRODUCTDETAIL')));
            $data_oms=$this->Index_OMS(C('OMS_PRODUCTDETAIL'),array('goodId'=>$sku_oms));
            $proguct_Logic=new Products();
            $data=$proguct_Logic->oper_product_b2c_oms(json_decode($data_b2c,true),json_decode($data_oms,true));
            $add_goods['goodId']=$sku_oms;
            $add_goods['price']=$data['result']['marked_price'];
            $add_goods['name']=$data['result']['name'];
            $add_goods['image']=$data['result']['product_img'];
            $goods=new Goods();
            $goods->add($add_goods);
        }
        return $data;
    }


    /***
     * 短信测试接口
     */
//    public function test_sendmsg(){
//        $sendmsg=new SendMsg();
//        $mobile = "15811390401";
//        $vcode = "您短信的验证码：111111,请您在2分钟之内填写，[环球购物]";
//        $res= $sendmsg->SendSms($mobile,$vcode);
//        echo $res;
//    }

}