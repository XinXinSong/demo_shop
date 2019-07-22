if(_require_config != undefined) {
	require.config(_require_config);
}

require(['mui', 'jQuery', 'ghsUtils'], function(mui, jQuery, ghsUtils) {
	//执行公有的方法
	ghsUtils.main();
	$("#a-no").click(function() {
		$("#paper-bill").hide();
		$("#elec-bill").hide();
	});
	$("#a-paper").click(function() {
		$("#paper-bill").show();
		$("#elec-bill").hide();
	});
	$("#a-elec").click(function() {
		$("#paper-bill").hide();
		$("#elec-bill").show();
	});
});