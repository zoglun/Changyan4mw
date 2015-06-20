<?php
//接口公共部分
error_reporting(E_ALL);



/**
 * 一个完整的加载mw框架的过程是这样的..
 * =====
 * require('global.php');
 * //加载框架
 * mw_head();
 * 
 * //TODO:写你的代码
 * 
 * //脚本结束时还要执行一些操作，姑且叫他结束框架吧
 * mw_foot();
 * ======
 */


//判断MW_SYSDIR是否为空



$mwpath=getmwpath();

putenv("MW_INSTALL_PATH=$mwpath"); 
require("$mwpath/includes/WebStart.php");
//加载用户设置
require("$mwpath/LocalSettings.php");

//获取mw安装目录
function getmwpath(){
    //注意：这里的反斜杠仅适用于linux，windows下尚未补全
    $path=explode('/',__DIR__);
    $workpath_array=array_splice($path,1,-3);
    $workpath="";
    foreach($workpath_array as $i){
        
            $workpath.='/'.$i;
    }
    return $workpath;
}

//加载mw框架尾部部分
    function mw_foot(){
    //通过参考api.php，在加载框架最后需要关闭数据库连接
        $lb = wfGetLBFactory();
        $lb->shutdown();
    }
?>