<?php
return array(
	//'配置项'=>'配置值'
    //oms的接口地址
    'OMS_HOST'=>'http://12.17.13.16:8084/',
    'OMS_HOST_CUSTOMER'=>'http://12.17.13.15:8082/',
    'OMS_HOST_TV'=>'http://12.17.13.17:8086/',
    'OMS_HOST_ORDER'=>'http://12.17.13.17:8085/',
    //oms的接口（当需要tp框架处理逻辑时）
    //直播节目信息
    'OMS_INTERFACE_TV'=>'programRestApi.program.getProgramInfoForAWeek',
    //商品信息
    'OMS_PRODUCTDETAIL'=>'goodsRestApi.goods.goodsInfo',
    //根据手机号查询客代号
    'OMS_CUSTBYPHONENUM'=>'customerRestApi.customer.getCustomerCustId',
    //修改密码
    'OMS_EDITPASSWORD'=>'omsRestApi.oms.modifyPassword',
    //登录
    'OMS_LOGIN'=>'omsRestApi.oms.login',



    //b2c的接口（当需要tp框架处理逻辑时）
    //商品详情
    'B2C_PRODUCTDETAIL'=>'b2c.product2.app_productBaseInfo',
    //商品库存
    'B2C_PRODUCTSTORE'=>'goodsRestApi.goods.stockList',
    //商品赠品
    'B2C_PRODUCTPGIFT'=>'goodsRestApi.goods.giftList',

    //默认图片
    'BASE_IMG'=>'http://172.17.0.1:16080/public/app/desktop/statics/login.png',

    //短信验证码过期时间(分钟)
    'SMSCODETIME'=>2,

//    'B2C_HOST'=>'http://11.1.2.210:16080/index.php/api',
    //'B2C_HOST'=>'http://test.ghs.net/index.php/api',
    'B2C_HOST'=>'http://testec.ghs.net/index.php/api',
    //b2c接口检验需要的证书
    'CERTIFICATE'=>array (
        'CERTIFICATE_ID' => '1584185630',
        'TOKEN' => 'f636f9f48eeeead453289e5254e37067a3ee934bc0340386d9b7c9f544bfbc3d',
        'VALID' => '0',
    ),
    //本地数据库配置
//    'DB_TYPE'               =>  'mysql',     // 数据库类型
//    'DB_HOST'               =>  '172.17.0.1', // 服务器地址
//    'DB_NAME'               =>  'tp_demo',          // 数据库名
//    'DB_USER'               =>  'root',      // 用户名
//    'DB_PWD'                =>  '123456',          // 密码
//    'DB_PORT'               =>  '13366',        // 端口
    //开发数据库配置
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '12.17.1.7', // 服务器地址
    'DB_NAME'               =>  'tp_demo',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root123',          // 密码
    'DB_PORT'               =>  '3306',        // 端口



    //支付宝相关配置

    'alipay_config'=>array(
        //↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'partner'		=> '2088211363531221',

        //收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
        'seller_id'	=> '2088211363531221',

        // MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'key'			=> 'd8r9rvmqe2f5n4n38154rntcawf6f9pj',
        // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=>123这类自定义参数，必须外网可以正常访问
        'notify_url' => "http://m.globalgo.com.cn/index.php/Home/AlipayWapPayDirect/notify",

        // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=>123这类自定义参数，必须外网可以正常访问
        'return_url' => "http://m.globalgo.com.cn/return_url.php",

        //签名方式
        'sign_type'    => strtoupper('MD5'),

        //字符编码格式 目前支持utf-8
        'input_charset'=> strtolower('utf-8'),

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        'cacert'    => getcwd().'\\cacert.pem',

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        'transport'    => 'http',

        // 支付类型 ，无需修改
        'payment_type' => "1",

        // 产品类型，无需修改
        'service' => "alipay.wap.create.direct.pay.by.user",

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
    ),
//    'ALIPAY_CONFIG' =>   array (
//        //应用ID,您的APPID。
//        'app_id' => "2088211363531221",
//
//        //商户私钥，您的原始格式RSA私钥
//        'app_private_key' => "d8r9rvmqe2f5n4n38154rntcawf6f9pj",
//
//        //异步通知地址
//        'notify_url' => "http://m.globalgo.com.cn/index.php/Home/AlipayWapPay/notify_url",
//
//        //同步跳转
//        'return_url' => "http://m.globalgo.com.cn/index.php/Home/AlipayWapPay/return_url",
//
//        //编码格式
//        'charset' => "UTF-8",
//
//        //签名方式
//        'sign_type'=>"RSA2",
//
//        //支付宝网关
//        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
//
//        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
//        'alipay_public_key' => "111111111",
//
//
//    ),
    'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/dispatch_jump.tpl', // 默认成功跳转对应的模板文件

    'ALIPAY_SUCCESS'=>'http://m.globalgo.com.cn/alipay_success.html',//支付成功跳转页面
    'ALIPA_ERROR'=>'http://m.globalgo.com.cn/alipay_error.html',//支付失败跳转页面
);