//轮播图接口
function getIndexAdverts(resultData) {
		if(resultData.status === "success") {
				var returnData = resultData.result;
				$("#ghs-slider-group").empty();
				$("#ghs-slider-indicator").empty();
				var size = returnData.length;
				var gdsLinklist = [];//存储商品ID
				for(var index = 0 ; index < size; index++) {
					var goodsLink = returnData[index].link;
					if(goodsLink.substr(0,4) != "http")
					   goodsLink = "goods.html?goodsId=" + goodsLink;
					gdsLinklist.push(goodsLink);
					$("#ghs-slider-group").append("<div class='mui-slider-item'><a href='"+goodsLink+"'><img src='" + returnData[index].image + "' /></a></div>");
					$("#ghs-slider-indicator").append("<div class='mui-indicator'></div>");
				}
				$("#ghs-slider-group").prepend("<div class='mui-slider-item mui-slider-item-duplicate'><a href='"+gdsLinklist[size-1]+"'><img src='" + returnData[size - 1].image + "' /></a></div>");
				$("#ghs-slider-group").append("<div class='mui-slider-item mui-slider-item-duplicate'><a href='"+gdsLinklist[0]+"'><img src='" + returnData[0].image + "' /></a></div>");
		}
}
//TV抢购接口
function getIndexHotGoods(resultData) {
		if(resultData.status === "success") {
				$("#hotGoods").empty();
				var returnData = resultData.result;
				for(var index = 0, size = returnData.length; index < size; index++) {
					var goods = returnData[index];
					$("#hotGoods").append("<div class='showGoods' id='"+goods.goodId+"'>"
					+"<img src='"+goods.image+"' /><div class='name'>"+goods.goodNm+"</div>"
							+"<div class='price'>￥"+goods.price+"&nbsp;<span class='old-price'>￥"+goods.marked_price+"</span></div></div>");
				}
		}
}
//猜你喜欢接口
function getIndexGuessLike(resultData) {
		if(resultData.status === "success") {
				$("#GuessLike").empty();
				var returnData = resultData.result.ad_list,
				size = resultData.result.total_count;
				for(var index = 0; index < size; index++) {
					var goods = returnData[index];
					if(goods.type == "2")
					    continue;
					var goodsLink = goods.link;
					if(goods.type == "1")
					    goodsLink = "goods.html?goodsId=" + goodsLink;
					$("#GuessLike").append("<a href='"+goodsLink+"' ><img src='"+ goods.image +"' class='bigImg'/></a>");
				}
		}
}
//热搜接口
function getIndexHotSearch(resultData) {
		if(resultData.status === "success") {
			var returnData = resultData.result;
			for(var index = 0, size = returnData.length; index < size; index++) {
				var item = returnData[index];
				$("#hotGoodsKeys").append("<div class='goods-mark' style='color:"+item.color+";'>"+item.title+"</div>");
			}
		}
}