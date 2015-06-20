<?php
//接口公共部分

/**
 * 当你在安装后，调用接口出现类似于
 * failed to open stream: No such file or directory in xxxxxx
 * 之类的include找不到文件的情况，请指定您的mw系统在服务器上的绝对路径
 */
define('MW_SYSDIR','/home/ubuntu/workspace/mw/');//在此处填入您安装MW的绝对路径

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

if(defined(MW_SYSDIR) && constant(MW_SYSDIR)==''){
    $mwpath='../../..';
}else{
    $mwpath=MW_SYSDIR;
}
putenv("MW_INSTALL_PATH=$mwpath"); 
require("$mwpath/includes/WebStart.php");

//加载用户设置
require("$mwpath/LocalSettings.php");



//加载mw框架尾部部分
    function mw_foot(){
    //通过参考api.php，在加载框架最后需要关闭数据库连接
        $lb = wfGetLBFactory();
        $lb->shutdown();
    }
?>