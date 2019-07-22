var WebData = (function() {
	var webdata;

	function Construct() {
		var bigSize = 500; //默认值
		this.setSize = function(newSize) {
			bigSize = newSize;
		};
		var getKeys = function() {
			var keysTemp = [],
				Temp = null;
			Temp = localStorage.getItem("keys");
			if(Temp != undefined && Temp != null) {
				keysTemp = JSON.parse(Temp); //将字符串转为JSON对象
			}
			return keysTemp;
		};
		var setkeys = function(newKey, keys) { //keys是数组
			keys.push(newKey);
			//先将JSON对象转换为字符串再存入SessionStorage
			localStorage.setItem("keys", JSON.stringify(keys));
		};
		this.clearLocalData = function() {  //前提是key.length > bigSize
			var keyTemp = 0;
			var keys = getKeys(); //keys是数组
			var overIndex = Math.floor(bigSize / 2);
			for(var index = 0; index <= overIndex; index++) {
				keyTemp = keys.shift();
				localStorage.removeItem(keyTemp);
			}
			localStorage.setItem("keys", JSON.stringify(keys));
		};
		//获取JSON字符串
		this.getLocalJson = function(key) {
			var jsonData = null;
			if(window["localStorage"]) //首先判断浏览器是否支持
			{
				jsonData = localStorage.getItem(key);
				if(jsonData != undefined && jsonData != null) {
					jsonData = JSON.parse(jsonData); //将字符串转为JSON对象
				}
			}
			return jsonData;
		};
		//获取普通字符串
		this.getLocalStor = function(key) {
			var jsonData = null;
			if(window["localStorage"]) //首先判断浏览器是否支持
			{
				jsonData = localStorage.getItem(key);
			}
			return jsonData;
		};
		//设置JSon字符串
		this.setLocalJSon = function(key, jsonData) {
			if(window["localStorage"]) //首先判断浏览器是否支持
			{
				var keys = new Array();
				keys = getKeys();
				localStorage.setItem(key, JSON.stringify(jsonData));
				setkeys(key, keys);
				if(keys.length > bigSize) {
					this.clearLocalData();
				}
			}
		};
		//设置普通字符串
		this.setLocalStor = function(key, jsonData) {
			if(window["localStorage"]) //首先判断浏览器是否支持
			{
				var keys = [];
				keys = getKeys();
				localStorage.setItem(key, jsonData);
				setkeys(key, keys);
				if(keys.length > bigSize) {
					this.clearLocalData();
				}
			}
		};

        //获取普通字符串
		this.getSessionStor = function(key) {
			var returnData = null;
			if(window["sessionStorage"]) //首先判断浏览器是否支持
			{
				returnData = sessionStorage.getItem(key);
			}
			return returnData;
		};
		//获取JSON字符串
		this.getSessionJson = function(key) {
			var returnData = null;
			if(window["sessionStorage"]) //首先判断浏览器是否支持
			{
				returnData = sessionStorage.getItem(key);
				if(returnData != undefined && returnData != null) {
					returnData = JSON.parse(returnData); //将字符串转为JSON对象
				}
			}
			return returnData;
		};
		//设置普通字符串
		this.setSessionStor = function(key, dataStr) {
			if(window["sessionStorage"]) //首先判断浏览器是否支持
			{
				sessionStorage.setItem(key, dataStr);
			}
		};
		//设置JSON字符串
		this.setSessionJson = function(key, dataStr) {
			if(window["sessionStorage"]) //首先判断浏览器是否支持
			{
				//先将JSON对象转换为字符串再存入SessionStorage
				sessionStorage.setItem(key, JSON.stringify(dataStr));
			}
		};
		
	}
	webdata = new Construct();
	return webdata;
})();