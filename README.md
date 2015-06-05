# Changyan4mw
Mediawiki 畅言评论插件
作者：技术萌(techmoe)<br>
更新时间：20150605
<h2>插件介绍</h2>
本插件实现了在MediaWiki中使用畅言进行评论的功能，并且实现了初步的单点登录功能
<br><br>
<h2>安装方法</h2>
首先下载源码包，将changyan_comment文件夹复制到mw安装目录下的extensions文件夹，然后打开mw根目录的LocalSettings.php，在后面添加如下代码
<pre>
$CY_APPID="此处替换为你的站点在畅言的APPID";
$CY_APPKEY="此处替换为你的站点在畅言的APPKEY";
require_once( "$IP/extensions/changyan_comment/changyan_comment.php");
</pre>
APPID和APPKEY在畅言后台【设置】-【通用设置】-【高级设置】中查看<br>
<img src="http://i1.tietuku.com/abda32c335d42a26.png" ><br>
然后请在畅言后台中进入【设置】-【PC端设置】-【单点登录】，之后在【获取用户信息接口URL】中填入<br>
http://<你的站点的域名>/extensions/changyan_comment/callback.php <br>
<img src="http://i1.tietuku.com/9b3e946166a74134.png">
<br><br>
<h2>目前存在的已知问题</h2>
1.畅言目前不支持https方式连接，也就是说，如果你的站点是使用https方式访问的话，Chrome等一些现代浏览器会阻止加载非http协议的畅言插件的js文
件。对于此问题已经通知了畅言官方，请等待官方解决<br>
2.目前的单点登录只支持“网站为主的单点”，也就是说，登陆MediaWiki账号的同时登陆畅言账号，但暂时还没有做到从畅言端登陆MediaWiki

<br><br>
作者bolg：<a href="http://cnblogs.com/techmoe" target="_blank">学园都市超科学的代码研究社</a> 欢迎前来交流<br>
mail:developershi@sina.cn
