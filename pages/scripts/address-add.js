if(_require_config != undefined) {
	require.config(_require_config);
}

require(['mui', 'jQuery','ghsUtils','picker', 'poppicker', 'city-data-3'], function(mui, jQuery,ghsUtils) {
	//执行公有的方法
	ghsUtils.main();
	var cityPicker3 = new mui.PopPicker({
			layer: 3,
			//buttons:['cancle','ok']
		});
		cityPicker3.setData(cityData3);
		mui('.ghs-box').on('click', '#select-area', function(event) {
			cityPicker3.show(function(items) {
				$("#select-area").val( (items[0] || {}).text + " " + (items[1] || {}).text + " " + (items[2] || {}).text);
			});
		});
});