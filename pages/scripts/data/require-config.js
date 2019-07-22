//页面引用的js链接地址
var _require_config = {
    //By default load any module IDs from js/lib
    baseUrl: 'scripts',
    paths: {
        'jQuery': ['http://cdn.bootcss.com/jquery/1.11.1/jquery.min','lib/jquery.min'],
        'bootstrap':['http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min','lib/bootstrap.min'],
        'dropload':'lib/dropload.min',
        'mui':['lib/mui.min','lib/mui'],
        'webStorage':['app/webStorage.min','app/webStorage'],
        'ghsUtils':['app/ghsUtils','app/ghsUtils'],
        'picker':['lib/mui.picker'],
        'poppicker':['lib/mui.poppicker'],
        'city-data-3':['data/city-data-3'],
        'definitions':['data/definitions-17.2.28.1']
    },
    shim : {
       'bootstrap':['jQuery'],
       'dropload':['jQuery'],
       'poppicker':['mui'],
       'picker':['mui'],
   }
};
