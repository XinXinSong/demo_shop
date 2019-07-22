if(_require_config != undefined){
	require.config(_require_config);
}
require(['mui', 'jQuery', 'webStorage', 'ghsUtils'], function(mui, jq, wd, ghsUtils) {
	//执行公有的方法
	ghsUtils.main();
	//猜你喜欢接口
	ghsUtils.ghsJSONP("http://12.17.1.4:8080/index.php/Home/PageIndex/Index?into=OMS&method=customerRestApi.customer.address.listByCustId&oms_hostBn=customer&custId="+"5778041","getIndexGuessLike");
});