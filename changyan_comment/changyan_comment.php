<?php
/* 
Changyan4MW -- Mediawikin畅言评论插件
more:https://github.com/moehub/Changyan4mw/

安装方法：
将整个changyan_comment文件夹复制到extensions文件夹
然后在你的mw的LocalSettings.php中添加如下代码，记得把下面的YOUR_APPID替换为你在畅言的站点APPID

$CY_APPID="YOUR_APPID";
require_once( "$IP/extensions/changyan_comment/changyan_comment.php");



*/

$wgExtensionCredits['specialpage'][] = array(
		'path'              => __FILE__,
		'name'              => 'changyan4mw',
		'version'           => '0.2',
		'author'            => 'techmoe',
		'description'       => 'Mediawiki 畅言评论插件',
		'descriptionmsg'    => 'desc',
		'url'               => 'http://cnblogs.com/techmoe'
);

$wgHooks['SkinAfterContent'][] = 'Changyan::onSkinAfterContent';


class Changyan {
	
	
	public static function onSkinAfterBottomScripts($skin, &$text){
		echo "testing..";
		return true;
	}
	public static function onSkinAfterContent(&$data, $skin = null){
		global $wgTitle, $wgRequest, $wgOut, $CY_APPID;
		if($wgTitle->isSpecialPage()
			|| $wgTitle->getArticleID() == 0
			|| !$wgTitle->canTalk()
			|| $wgTitle->isTalkPage()
			|| method_exists($wgTitle, 'isMainPage') && $wgTitle->isMainPage()
			|| in_array($wgTitle->getNamespace(), array(NS_MEDIAWIKI, NS_TEMPLATE, NS_CATEGORY))
			|| $wgOut->isPrintable()
			|| $wgRequest->getVal('action', 'view') != "view")
			return true;
		$data .='<!--高速版-->
<div id="SOHUCS"></div>
<script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
<script type="text/javascript">
    window.changyan.api.config({
        appid: "'.$CY_APPID.'"
    });
</script>        
';
		return true;
	}
}
?>