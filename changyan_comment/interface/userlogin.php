<?php
//畅言回调 用户登录接口

//加载MediaWiki框架
putenv("MW_INSTALL_PATH=../../.."); 
require("../../../includes/WebStart.php");
//加载用户设置
require("../../../LocalSettings.php");
//加载用户操作类
require('../unity/useraction.php');
//加载畅言签名生成类
require('../unity/changyan_sign.php');


$truesign=cySsoSign::loginsign($CY_APPKEY,$_GET['cy_user_id'],$_GET['img_url'],$_GET['nickname'],$_GET['profile_url'],$_GET['user_id']);
if($_GET['sign']!=$truesign) die('签名验证失败，请检查APPKEY是否正确');


if($_GET['user_id']==''){
    login_nouid();
}else{
    login_hasuid();
}

function login_hasuid(){
    $user = User::newFromId($_GET['user_id']);
    $mwuser->login($user);
    $ret=array(
        'user_id'=>$_GET['user_id'],
        'reload_page'=>1
        );
    echo $_GET['callback'].'('.json_encode($ret).')';
}
function login_nouid(){
    global $wgUser;
    if($wgUser->getId()==0){
        $ret=array(
        'user_id'=>'1',
        'reload_page'=>0
        );
    }else{
        $ret=array(
        'user_id'=>$wgUser->getId(),
        'reload_page'=>1
        );
    }
    echo $_GET['callback'].'('.json_encode($ret).')';
}




//通过参考api.php，在加载框架最后需要关闭数据库连接
$lb = wfGetLBFactory();
$lb->shutdown();

?>
