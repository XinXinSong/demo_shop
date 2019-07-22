//名词解释定义配置表
/* 
 name:对应名词
 desc:名词详细
*/
var _definitions = {
	'memberCountT': { //会员
		'name': '会员总数',
		'desc': 'LD数据库里唯一客代号总数'
	},
	'memberRateT': {
		'name': '近两周会员重购率',
		'desc': '近两周成功签收两单或以上会员数 ÷ 近两周成功签收会员数 × 100%'
	},
	'memberAddCountT': {
		'name': '今日新增订单会员',
		'desc': '之前未成功订购(包括今日新注册的会员)，今日成功订购的会员数'
	},
	'monthMember_addCountT': {
		'name': '近一年每月新增订单会员数',
		'desc': '之前未成功订购，当月成功订购的会员数'
	},
	'monthMember_repeatCountT': {
		'name': '每月会员二次重购数',
		'desc': '统计周期前有过成功订购记录，在统计周期内再次成功订购的会员数。'
	},
	//电购
	'IVRT': {
		'name': 'IVR埋点信息',
		'desc': '暂无'
	},
	'call_allCountT': {
		'name': '今日总进线量',
		'desc': '北京+全国人工总进线量 + 自助语音总进线量'
	},
	'vol_allCountT': {
		'name': '今日总成交量',
		'desc': 'TV渠道成交量 + 自助语音成交量'
	},
	'vol_allRateT': {
		'name': '今日总成交率',
		'desc': '今日总成交量 ÷ 今日总进线量 × 100%，保留两位小数'
	},
	'call_tsCountT': {
		'name': '人工进线量',
		'desc': '北京 + 全国人工进线量'
	},
	'vol_tsCountT': {
		'name': '人工成交量',
		'desc': '订单类型为主品，商品不为特搭商品，TV渠道，订单不为自助语音订单的净订单量'
	},
	'vol_tsRateT': {
		'name': '人工成交率',
		'desc': '人工成交量÷人工进线量 × 100%，保留两位小数'
	},
	'call_sdCountT': {
		'name': '自助进线量',
		'desc': '自助语音进线量'
	},
	'vol_sdCountT': {
		'name': '自助成交量',
		'desc': '订单下单人为SDORD的净订单'
	},
	'vol_sdRateT': {
		'name': '自助成交率',
		'desc': '自助成交量 ÷ 自助进线量 × 100%，保留两位小数'
	},
	'provinceVolT': {
		'name': '省份净订购金额图',
		'desc': '订单类型为主品，商品不为搭销商品，商品名称不含跨境品，体验的商品，商品价格大于0，非取消订单在各个省份的订购金额税后'
	},
	'provinceAddT': {
		'name': '省份日增长排行TOP10',
		'desc': '昨日各个省份的订购金额税后 ÷ 各省份昨日前三天平均订购金额税后，取前10省份'
	},
	//电商
	'PVT': {
		'name': '今日PV',
		'desc': 'APP端页面浏览量(Page Visitor)'
	},
	'UVT': {
		'name': '今日UV',
		'desc': '应为电商所有的用户访问量(User Visitor)，但是目前UV只有APP的UV，无网页UV'
	},
	'buyCountT': {
		'name': '今日电商成交量',
		'desc': '电商所有渠道净订单数量'
	},
	'uvRateT': {
		'name': '今日APP访问成单转化率',
		'desc': 'UV成交量 ÷ UV × 100% (UV成交量目前就是app的成交量)'
	},
	'pv—uv_weekT': {
		'name': '近七天访问量',
		'desc': '近七天的PV和UV'
	},
	'buyCount_weekT': {
		'name': '近七天电商成单量',
		'desc': '近七天电商所有渠道净订单数量'
	},
	'uvRate_weekT': {
		'name': '近七天APP转化率',
		'desc': '近七天每天的 UV成交量 ÷ UV × 100%'
	},
	//商品
	'dayRateT': {
		'name': '今日有效金额平均达标率',
		'desc': '当日播出商品平均有效订购金额达标率。（有效订购金额达标率=商品有效订购金额÷有效订购金额目标，有效订购金额=当日播出商品，TV渠道，非取消订单，节目内订单延时90分钟的有效订购金额）'
	},
	'commodity_hotnameT': {
		'name': '今日最热商品',
		'desc': '当日有效订购金额达标率最高商品'
	},
	'hotGoodsT': {
		'name': '商品热销Top',
		'desc': '当日有效订购金额达标率最高5款商品'
	},
	'clodObjectsT': {
		'name': '滞销Top',
		'desc': '当日有效订购金额达标率最低5款商品'
	},
	'channels_rateT': {
		'name': '商品处别有效金额平均达标率',
		'desc': '处别当日商品有效金额达标率之和 ÷ 处别当日商品数量 × 100%'
	},
	//仓储
	'outputT': {
		'name': '今日出库总单数',
		'desc': '当日出库的总订单数量'
	},
	'retentionT': {
		'name': '今日滞留总单数',
		'desc': '50天~2天前的订单，订单状态为未出库的订单数量'
	},
	'storage_rateT': {
		'name': '24小时出库率',
		'desc': '24小时内出库订单数量÷近7日所有出库订单数量 × 100%'
	},
	'dayTimeRateT': {
		'name': '近七天24小时出库率',
		'desc': '近7日所有24小时内出库订单数量÷近7日所有出库订单数量 × 100%'
	},
	'subWareT': {
		'name': '各仓库出库信息',
		'desc': '当日各个仓库出库订单数量'
	},
	'subDuty_countT': {
		'name': '各责任部门滞留单情况',
		'desc': '滞留单状态为欠交订单，责任部门为商品部，滞留单状态为订单受理，责任部门为电话销售部，其他责任部门为仓储部。'
	},
	//配送--物流
	'distribution_youxiaoT': {
		'name': '两周前配送有效率',
		'desc': '签收订单数 ÷ 配送订单量 × 100%'
	},
	'distribution_tousuT': {
		'name': '两周前投诉率',
		'desc': '当周客诉量 ÷当期接货单量(只计算CS类型为“客诉”的CS信息) × 100%'
	},
	'tuotou_rateT': {
		'name': '近7周每周妥投率(单位:%)',
		'desc': '（当周签收订单数 + 销退订单数） ÷ 当期配送订单量 × 100%'
	},
	'jisi_rateT': {
		'name': '近7周每周配送及时率(单位:%)',
		'desc': '当周及时配达订单数（签收÷拒收，并且按照规定时间完成配送） ÷当期接货单量 × 100%'
	},
	'youxiao_rateT': {
		'name': '近7周每周配送有效率(单位:%)',
		'desc': '当周签收订单数 ÷ 当期配送订单量 × 100%'
	},
	'tuosu_rateT': {
		'name': '近7周每周投诉率(单位:%)',
		'desc': '投诉量 ÷ 当期接货单量(只计算CS类型为“投诉”的CS信息) × 100%'
	},
	//售后
	'sales_callT': {
		'name': '今日进线量',
		'desc': '今日售后进线数量'
	},
	'sales_holdUpT': {
		'name': '今日接起量',
		'desc': '今日售后接起数量'
	},
	'sales_rateT': {
		'name': '今日接起率',
		'desc': '今日接起量 ÷ 今日进线量 × 100%'
	},
	'evaluteT': {
		'name': '客户进线评价',
		'desc': '当天进线满意度'
	},
	'untreated_countT': {
		'name': '72小时未结案数量',
		'desc': '近7天72小时内未结案的数量'
	},
	'untreated_rateT': {
		'name': '72小时未结案率',
		'desc': '近7天72小时未结案数量 ÷ 近7天全部投诉数量 × 100%'
	},
	//财务  
	'totalT': {
		'name': '今日净订购金额',
		'desc': '当日全部渠道全部商品的净订购金额税后'
	},
	'refundMoneyT': {
		'name': '今日退款金额',
		'desc': '退款日期为当日，退款状态为完成的退款金额'
	},
	'everyChannelT': {
		'name': '各个渠道金额和占比',
		'desc': '当日各个渠道全部商品的净订购金额税后和占比'
	},
	'paywayT': {
		'name': '支付方式占比',
		'desc': '当日全部净订单支付方式占比'
	},
	//IVR详细信息
	'IVRinfo-fail': {
		'name': '失败相信信息',
		'desc': '暂无'
	},
	'IVRinfo-transfer': {
		'name': '转人工详细信息',
		'desc': '暂无'
	},
	'IVRinfo-hangUp': {
		'name': '挂机详细信息',
		'desc': '暂无'
	}
}