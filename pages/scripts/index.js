if(_require_config != undefined){
	require.config(_require_config);
}
require(['mui', 'jQuery', 'webStorage', 'ghsUtils'], function(mui, jq, wd, ghsUtils) {
	//执行公有的方法
	ghsUtils.main();
	/*document.querySelector('.mui-slider').addEventListener('slide', function(event) {
		//注意slideNumber是从0开始的；
		var loginText = "你正在看第" + (event.detail.slideNumber + 1) + "张图片";
		alert(loginText);
	});*/
	//限时抢购模块的点击事件
	mui("#hotGoods").on('click', '.showGoods', function() {
		if(this.id){
		   window.location.href = "goods.html?goodsId="+this.id;
		}
	});
	
	//搜索模态框的点击事件
	mui("#search-container").on('click', '#cancel', function() {
		document.getElementById("search-container").style.display = "none";
	});
	//搜索输入框的点击事件
	mui(".search-box").on('click', '#search-box', function() {
		document.getElementById("search-container").style.display = "block";
	});
	//热搜标签的点击事件
	mui("#hotGoodsKeys").on('click', '.goods-mark', function() {
		$("#searchInput").val(this.innerText);
		window.location.href = "goodsSearch.html?goodsId="+this.innerText;
	});
	//搜索框enter事件
	$('#searchInput').bind('keypress', function (event) {
        if (event.keyCode == "13") {
            window.location.href = "goodsSearch.html?goodsId="+this.value;
        }
    });
	
	//轮播图接口
	ghsUtils.ghsJSONP("http://12.17.1.4:8080/index.php/Home/PageIndex/Index?into=B2C&method=b2c.advertising2.homefocus&direct=true","getIndexAdverts");
	//TV抢购接口
	ghsUtils.ghsJSONP("http://12.17.1.4:8080/index.php/Home/PageIndex/Index?method=gettv_index&oms_hostBn=tv&soId=1000001","getIndexHotGoods");
	//猜你喜欢接口
	ghsUtils.ghsJSONP("http://12.17.1.4:8080/index.php/Home/PageIndex/Index?into=B2C&method=b2c.advertising2.getad&direct=true","getIndexGuessLike");
	//热搜接口
	ghsUtils.ghsJSONP("http://12.17.1.4:8080/index.php/Home/PageIndex/Index?into=B2C&method=b2c.goods2.search_goods_hot&direct=true","getIndexHotSearch");
});