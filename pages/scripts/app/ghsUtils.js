define(['mui'],function() {
	/* 页面公有方法，页面加载成功后都需要执行的方法 */
	var _main = function(){
		mui.init();
	    //返回点击事件
	    mui(".topTile").on('click', '.return', function() {
		   history.back();
	    });
	    //点击跳转事件
	    mui("body").on('click', '.clickEvent', function() {
		  if(this.id){
		     window.location.href = this.id;
		  }
	    });
	}
	/* 工具类  */
	var _ghsJSONP = function(url, callback) {
		// 创建script标签，设置其属性
		var script = document.createElement('script');
		script.setAttribute('src', url + "&provisional="+callback);
		// 把script标签加入head，此时调用开始
		document.getElementsByTagName('head')[0].appendChild(script);
	}
	//输出带“,”的数字格式,注：返回字符串格式的数字
	var _showGhsNumber = function(oldNum) {
		var newNum = oldNum + "";
		if(/^\d+(.\d)?\d{0,}$/.test(newNum)) {
			var endNum = "",
				beginNum = "";
			var pointer = newNum.indexOf(".");
			if(pointer > 0) {
				beginNum = newNum.substr(0, pointer);
				endNum = newNum.substr(pointer);
				newNum = addNumPointer(beginNum) + endNum
			} else {
				newNum = addNumPointer(newNum);
			}
		}
		return newNum;
	}

	var _addNumPointer = function(oldNum) {
		var newNum = "";
		for(var index = 0, size = oldNum.length; index < size; index++) {
			var charIndex = size - 1 - index;
			if((index + 1) % 3 == 0 && oldNum[charIndex - 1])
				newNum = "," + oldNum[charIndex] + newNum;
			else
				newNum = oldNum[charIndex] + newNum;
		}
		return newNum;
	}
	return {
		ghsJSONP:_ghsJSONP,
		showGhsNumber:_showGhsNumber,
		addNumPointer:_addNumPointer,
		main:_main
	};
})