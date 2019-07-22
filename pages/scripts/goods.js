if(_require_config != undefined){
	require.config(_require_config);
}
require(['mui', 'jQuery', 'webStorage', 'ghsUtils'], function(mui, jq, wd, ghsUtils) {
	//执行公有的方法
	ghsUtils.main();
	var goodsId = ""
	var search = location.search;
	if(search != "") {
		search = search.substr(1); //去除开头的“？”
		var paras = search.split("&");
		for(var index = 0, size = paras.length; index < size; index++) {
			var para = paras[index].split("=");
			if(para[0] === "goodsId")
				goodsId = para[1];
		}
	}
	if(goodsId != "") {
	  //猜你喜欢接口
	  ghsUtils.ghsJSONP("http://12.17.1.4:8080/index.php/Home/PageIndex/Index?method=get_productDetail&sku="+goodsId,"getGoodsShowInfo");
	}
});