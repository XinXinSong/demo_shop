if(_require_config != undefined) {
	require.config(_require_config);
}

require(['mui', 'jQuery', 'webStorage', 'ghsUtils'], function(mui, jq, wd, ghsUtils) {
	//执行公有的方法
	ghsUtils.main();
	$(".pay-box").on("click", ".pay-item", function() {
		$(this).find("input").prop("checked", "checked");
		$(this).parent().find(".pay-item").removeClass("ghs-color");
		$(this).addClass("ghs-color");
	});
});