//展示搜索出来的商品信息
function getGoodsSearchShowGoods(resultData) {
		if(resultData.status === "success") {
				var returnData = resultData.result.data;
				$("#goodsSearch-content").empty();
				var size = returnData.length;
				for(var index = 0 ; index < size; index++) {
					var goodsLink = returnData[index];
					var goods = returnData[index];
					$("#goodsSearch-content").append("<div class='showGoods-box'><div class='showGoods clickEvent' id='goods.html?goodsId="+goods.sku+"' >"
					+"<img src='"+goods.image+"' /><div class='name'>"+goods.name+"</div>"
							+"<div class='price'>￥"+goods.price+"&nbsp;<span class='old-price'>￥"+goods.market_price+"</span><img src='img/shop.png' /></div></div></div>");
				}
		}
}