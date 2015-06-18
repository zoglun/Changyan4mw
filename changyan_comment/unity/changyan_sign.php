<?php
//生成畅言签名
class cySsoSign
    {
        public static function sign($key, $imgUrl, $nickname, $profileUrl, $isvUserId){
            $toSign = "img_url=".$imgUrl."&nickname=".$nickname."&profile_url=".$profileUrl."&user_id=".$isvUserId;
            $signature = base64_encode(hash_hmac("sha1", $toSign, $key, true));
            return $signature;
        }
        public static function loginsign($key,$cyuserid, $imgUrl, $nickname, $profileUrl, $isvUserId){
            $toSign = "cy_user_id".$cyuserid."&img_url=".$imgUrl."&nickname=".$nickname."&profile_url=".$profileUrl."&user_id=".$isvUserId;
            $signature = base64_encode(hash_hmac("sha1", $toSign, $key, true));
            return $signature;
        }
    }

?>