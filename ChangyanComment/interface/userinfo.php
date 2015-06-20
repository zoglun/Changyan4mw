<?php
/*
Changyan4mw 畅言回调接口
配置方法见README
*/




//加载接口公共头部
include('global.php');




changyan_sso::getuserinfo();


class changyan_sso {
    public static function getuserinfo(){
        global $CY_APPKEY,$wgUser;
        if($wgUser->getId()!=0){
            $ret=array(
            "is_login"=>1,
            "user"=>array(
            "user_id"=>$wgUser->getId(),
            "nickname"=>$wgUser->getName(),
            "img_url"=>"",
            "profile_url"=>"",
            "sign"=>cySsoSign::sign($CY_APPKEY,"",$wgUser->getName(),"",$wgUser->getId())
            ));
        

        }else{
            $ret=array("is_login"=>0);
        }
        
        echo $_GET['callback'].'('.json_encode($ret).')';
        
    }
}

//生成畅言回调签名
class cySsoSign
    {
        public static function sign($key, $imgUrl, $nickname, $profileUrl, $isvUserId){
            $toSign = "img_url=".$imgUrl."&nickname=".$nickname."&profile_url=".$profileUrl."&user_id=".$isvUserId;
            $signature = base64_encode(hash_hmac("sha1", $toSign, $key, true));
            return $signature;
        }
    }
	
//结束框架
mw_foot();

?>