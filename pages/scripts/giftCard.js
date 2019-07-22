if(_require_config != undefined) {
	require.config(_require_config);
}

require(['mui', 'jQuery','ghsUtils'], function(mui, jQuery,ghsUtils) {
	//执行公有的方法
	ghsUtils.main();
});