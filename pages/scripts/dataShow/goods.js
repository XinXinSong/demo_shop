//展示搜索出来的商品信息
function getGoodsShowInfo(resultData) {
		if(resultData.status === "success") {
				var returnData = resultData.result;
				$("#ghs-slider-group").empty();
				$("#ghs-slider-indicator").empty();
				//展示商品图片
				var images = returnData.images;
				var images_length= images.length;
				for(var index = 0 ; index < images_length; index++) {
					$("#ghs-slider-group").append("<div class='mui-slider-item'><img src='" + images[index].image + "' /></div>");
					$("#ghs-slider-indicator").append("<div class='mui-indicator'></div>");
				}
				$("#ghs-slider-group").prepend("<div class='mui-slider-item mui-slider-item-duplicate'><img src='" + images[images_length-1].image + "' /></div>");
				$("#ghs-slider-group").append("<div class='mui-slider-item mui-slider-item-duplicate'><img src='" + images[0].image + "' /></div>");
				$("#goodsName").text(returnData.name);
				$("#goods_price").text("￥"+returnData.price);
				$("#goods_old-pric").text("￥"+returnData.marked_price);
				//展示商品特性标签
				var service_promise = returnData.service_promise;
				$("#goods-info-mark").empty();
				for(var index = 0 ,length = service_promise.length; index < length; index++) {
					$("#goods-info-mark").append("<img src='img/sd_spxq_ys.png' />"+service_promise[index].promise_name+"&nbsp;&nbsp;");
				}
				//展示商品详情相关图片
				var detail_imgs = returnData.detail_imgs;
				$("#detail_imgs").empty();
				for(var index = 0 ,length = detail_imgs.length; index < length; index++) {
					$("#detail_imgs").append("<img src='"+detail_imgs[index]+"' class='bigImg'/>");
				}
		}
}