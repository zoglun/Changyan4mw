<?php
//用户登出接口

//加载接口公共头部
include('global.php');
//加载用户操作类
require('../unity/useraction.php');

//这一步的目的是：当mw端未登录，畅言端已登陆的情况下只登出畅言端而跳过登出mw的环境，减少了一步刷新
if($wgUser->getId()==0){
    $return=array(
    'code'=>1,
    'reload_page'=>0
    );
}else{
    $mwuser->logout();
    $return=array(
    'code'=>1,
    'reload_page'=>1
    );
}



//返回参数
if(empty($_GET['callback'])) {
            echo 'no_callback'.'('.json_encode($ret).')';
            
        }else{
            echo $_GET['callback'].'('.json_encode($ret).')';
        }
//结束框架
mw_foot();

?>