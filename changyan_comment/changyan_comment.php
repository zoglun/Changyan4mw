<?php

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
		$data .='<!--高速版-->
<div id="SOHUCS"></div>
<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
<script type="text/javascript">
    window.changyan.api.config({
        appid: "cyrNJaVbr",
        conf: "prod_c780bd492562f1b64ac67a1c591bb236"
    });
</script>        
';
		return true;
	}
}
?>