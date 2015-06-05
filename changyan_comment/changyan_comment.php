<?php
/* 
Changyan4MW -- Mediawikin畅言评论插件
more:https://github.com/moehub/Changyan4mw/

安装方法请见README

*/

//注册插件信息
$wgExtensionCredits['specialpage'][] = array(
		'path'              => __FILE__,
		'name'              => 'changyan4mw',
		'version'           => '0.2',
		'author'            => 'techmoe',
		'description'       => 'Mediawiki 畅言评论插件',
		'descriptionmsg'    => 'desc',
		'url'               => 'http://cnblogs.com/techmoe'
);

//挂钩子
$wgHooks['SkinAfterContent'][] = 'Changyan::onSkinAfterContent';
$wgHooks['UserLogoutComplete'][] = 'Changyan::onUserLogoutComplete';

class Changyan {
	
	
    //插评论框
	public static function onSkinAfterContent(&$data, $skin = null){
		global $wgTitle, $wgRequest, $wgOut, $CY_APPID,$wgUser;
		
		//判断是否加载评论框
		//比如说如果碰见登陆界面之类的地方就直接跳出，不显示评论框
		if($wgTitle->isSpecialPage()
			|| $wgTitle->getArticleID() == 0
			|| !$wgTitle->canTalk()
			|| $wgTitle->isTalkPage()
			|| method_exists($wgTitle, 'isMainPage') && $wgTitle->isMainPage()
			|| in_array($wgTitle->getNamespace(), array(NS_MEDIAWIKI, NS_TEMPLATE, NS_CATEGORY))
			|| $wgOut->isPrintable()
			|| $wgRequest->getVal('action', 'view') != "view")
			return true;
			
			$sourceid=$wgTitle->getArticleID(); //这里把畅言的sourceid直接设成文章ID
		$data .='
		<div id="SOHUCS" sid="'.$sourceid.'"></div>
		<!--高速版-->
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
	
	//当用户退出时调用畅言的接口清除畅言那边的cookie
	public static function onUserLogoutComplete(&$user, &$inject_html, $old_name){
		global $CY_APPID;
		$inject_html.="
		<script>
	var img = new Image(); 
	img.src='http://changyan.sohu.com/api/2/logout?client_id=$CY_APPID&callback=C66A5BAD9ED000011E5A1F685821111F';
</script>
		";
	}
		
}
?>