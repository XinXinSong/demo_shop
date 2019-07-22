<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 17-3-23
 * Time: 下午4:12
 */
namespace Home\Services\Logic;
class SiteNo{
  private $area_post_arr = null;
    public function __construct()
    {
        if($this->area_post_arr==null){
            $this->area_post_arr=array(110000=>'beijing',120000=>'tianjin',130000=>'hebei',140000=>'shanxione',210000=>'liaoning',220000=>'jilin',230000=>'heilongjiang',310000=>'shanghai',320000=>'jiangsu',330000=>'zhijiang',340000=>'anhui',350000=>'fujian',360000=>'jiangxi',370000=>'shandong',410000=>'kenan',420000=>'hubei',430000=>'hunan',440000=>'guangdong',450000=>'guangxi',500000=>'chongqing',510000=>'sichuan',520000=>'guizhou',530000=>'yunnan',610000=>'shanxitwo',620000=>'gansu',640000=>'ningxia',650000=>'xinjiang',150900=>'wulanchabu',150300=>'wuhai',152200=>'xinganmeng',150200=>'baotou',150700=>'hulunbeier',150100=>'huhehaote',150800=>'bayanzhuoer',150400=>'chifeng',150500=>'tongliao',150600=>'eerduosi',152500=>'xilinguolemeng',152900=>'alashanmeng',630000=>'qinghai',460000=>'hainan');
        }
    }

    /***
     * //北京1仓 全国发货.
    //2赠品判断
    //"C23"==长沙仓
    //"C26"==沈阳
    //"C24"==北京2仓
    //"C28"==昆山仓
    //"C27"==北京1仓
    //C127北1虚拟仓库（搬库时临时加的）
     * @param $area
     * @return array
     */
    public  function GetSiteNo($area){    //LD仓库C23长沙；C28昆山；C27北京1；C24北京2；C26沈阳与地区对应 C99虚拟超卖仓库

        if($area =='anhui'|| $area =='jiangsu'|| $area =='zhijiang'||$area =='shanghai'||$area =='guangdong'|| $area =='guizhou'|| $area =='jiangxi'|| $area =='chongqing' || $area=='hainan'){
            $site_no_arr =array("C28","C27");
        }elseif($area =='liaoning'||$area =='heilongjiang'||$area =='jilin'||$area =='chifeng'||$area =='hulunbeier'||$area =='tongliao'||$area =='xinganmeng'){
            $site_no_arr =array("C26","C27");
        }elseif( $area =='guangxi' ||$area =='hubei'|| $area =='fujian'||$area =='hunan'|| $area =='sichuan'|| $area =='yunnan'){
            $site_no_arr =array("C23","C28","C27");
        }elseif($area =='beijing' || $area =='tianjin' || $area =='guizhou'){
            $site_no_arr =array("C24","C27");
        }else{
            $site_no_arr =array("C27");
        }
        //添加超卖虚拟仓库
        $site_no_arr[] = "C99";

        return $site_no_arr;

    }


    /***
     * 通过地区id获取仓库编号
     * @param $id
     * @return array
     */
    public function GetSiteNoById($id){
        $arr=$this->area_post_arr;
        return $this->GetSiteNo($arr[$id]);
    }
}