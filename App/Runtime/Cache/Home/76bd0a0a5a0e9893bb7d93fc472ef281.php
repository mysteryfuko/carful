<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE HTML> <head> 	<meta charset="UTF-8">	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>    <meta name="format-detection" content="telephone=no"/>    <meta name="apple-mobile-web-app-capable" content="yes" />		<link rel="stylesheet" href="/carful/Public/css/bootstrap.css">		<link rel="stylesheet" href="/carful/Public/JS/owl-carousel/owl.carousel.css">		<link rel="stylesheet" href="/carful/Public/JS/owl-carousel/owl.theme.css">		<script type="text/javascript" src="/carful/Public/js/jquery.min.js"></script>	<script type="text/javascript" src="/carful/Public/JS/XY_Dialog/XY_Base.js"></script>	<script type="text/javascript" src="/carful/Public/JS/owl-carousel/owl.carousel.min.js"></script>	 	<title></title>	<style type="text/css">      .head {        position:relative;        height:44px;        line-height:44px;        text-align:right;        color: #fff;        font-family: "微软雅黑";        background-color: #e4393c;        margin-bottom: 5px;      }      .thumbnail > img,.thumbnail a > img {        max-width: 100%;        height: 350px;      }      .thumbnail h3 {        font-family: "微软雅黑";        font-size: 14px;        text-align: center;      }      .thumbnail .caption {        padding: 0px;      }      .thumbnail a {        color: #3d3c41;      }      .footer{        color:#999;        text-align:center;        padding:30px 0;        margin-top:30px;        border-top:1px solid #e5e5e5;        background-color:#f5f5f5;        text-shadow: 0px 1px 0px #FFF;      }      .more {        border: 1px solid #eee;        font-size: 15px;        height: 35px;        line-height: 35px;        text-align: center;      }      .more a {        color: #a2a2a2;      }      .help-block span {        color: #e4393c;        padding: 0px 4px;      }		#owl-demo .item img{    display: block;    width: 100%;    height: auto;	}	#mess_share{margin:15px 0 5px 0; display: block}	#share_1{float:left;text-align:right;width:49%; display: block}	#share_2{float:right;width:49%; display: block}	#mess_share img{width:22px;height:22px;vertical-align: top;border: 0;}	#mcover{ position: fixed;	top:0;	left:0;	width:100%;	height:100%;background:rgba(0, 0, 0, 0.7);	display:none;z-index:20000;}	#mcover img {position: fixed;right: 18px;top:5px;width: 260px;height: 180px;z-index:20001;}	.button2{font-size:14px;padding:8px 0;}    </style><script type="text/javascript">Util.loadJS("XY_Dialog.js",function(){	$('.vote').live('click',function(){		$.post('/carful/index.php/Home/Index/ajaxPraise',		{		openid:'<?php echo ($openid); ?>',		id:<?php echo ($data["id"]); ?>		},		function(data){			if(data == 1){				Util.Dialog({				title : "纯文本内容",				boxID: "FormDialog",				showtitle : false,				width : 260,				height : 100,				fixed: false,				content : "text: <div class=\"typein\">感谢您的投票，我们将在胜出的宝贝的投票<br />者中随机抽取10位幸运用户赠送礼品<br/>请留下您的手机号码<br/><input type=\"hidden\" name=\"openid\" valu=\"\"><input type=\"text\" id=\"tel\"/><a href=\"javascript:;\" onclick=\"sumb()\">提交</a></div>"				});			}			if(data == 2){				alert('投票成功');				window.location.href="/carful/index.php/Home/Index/index";			}			if(data == 3){				alert('您每天只能给每位宝贝投一票');			}			//alert(data);		})	});});function sumb(){	$.post('/carful/index.php/Home/Index/ajaxAddUser',	{	openid:'<?php echo ($openid); ?>',	id:<?php echo ($data["id"]); ?>,	tel:$('#tel').val(),	},	function(data){		alert('投票成功');		Util.Dialog.close("FormDialog");		 window.location.href="/carful/index.php/Home/Index/index";	});}</script> </head> <body> <div id="mcover" onclick="document.getElementById('mcover').style.display='';"><img src="http://wxapi.weicehua.net/themes/Wap/default/common/images/ping/guide.png"></div>   <header>        <div class="head">        <div class="fl" style="width:100%;text-align:center">          <span>宝贝展示</span>          <div class="head-btn">          </div>        </div>      </div>   </header>    <div class="container">        <div class="row">          <div class="thumbnail">		  			<!-- 本例主要代码 Start ================================ -->			<div id="owl-demo" class="owl-carousel owl-theme">			<?php if(($data["pic1"]) != ""): ?><div class="item"><img src="<?php echo ($data["pic1"]); ?>" alt="The Last of us"></div><?php endif; ?>			<?php if(($data["pic2"]) != ""): ?><div class="item"><img src="<?php echo ($data["pic2"]); ?>" alt="The Last of us"></div><?php endif; ?>			<?php if(($data["pic3"]) != ""): ?><div class="item"><img src="<?php echo ($data["pic3"]); ?>" alt="The Last of us"></div><?php endif; ?>			 			</div>			<script type="text/javascript">			$(document).ready(function() { 			  $("#owl-demo").owlCarousel({			 				  navigation : false, // Show next and prev buttons				  slideSpeed : 300,				  paginationSpeed : 400,				  singleItem:true			 				  // "singleItem:true" is a shortcut for:				  // items : 1, 				  // itemsDesktop : false,				  // itemsDesktopSmall : false,				  // itemsTablet: false,				  // itemsMobile : false			 			  });			 			});			</script>            <div class="caption">              编号：carful<?php echo ($data["id"]); ?>参赛寄语：<?php echo ($data["content"]); ?>            </div>						<div id="mess_share">			<div id="share_1">			<button class="button2 vote"><img src="http://wxapi.weicehua.net/themes/Wap/default/common/images/ping/icon_msg.png">&nbsp;&nbsp;投票&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>			</div>			<div id="share_2">			<button class="button2" onclick="document.getElementById('mcover').style.display='block';"><img src="http://wxapi.weicehua.net/themes/Wap/default/common/images/ping/icon_timeline.png">&nbsp;分享到朋友圈</button>			</div>			<div class="clr"></div>			</div>			<br/>			<br/>          </div>  				     </div>    </div>     <div class="footer">      <address>        Copyright © 微策划科技 版权所有<br>        <abbr title="Phone">联系电话:</abbr> (0816) 2171030      </address>    </div></body><script>var imgUrl = "<?php echo ($data["pic1"]); ?>";var lineLink = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxe60a7669dfb88b33&redirect_uri="+document.URL+"&response_type=code&scope=snsapi_base&state="+<?php echo ($data["id"]); ?>+"#wechat_redirect";var descContent = "Carful宝贝";var shareTitle = 'Carful宝贝';var appid = '';function shareFriend() {    WeixinJSBridge.invoke('sendAppMessage',{                            "appid": appid,                            "img_url": imgUrl,                            "img_width": "640",                            "img_height": "640",                            "link": lineLink,                            "desc": descContent,                            "title": shareTitle                            }, function(res) {                            _report('send_msg', res.err_msg);                            })}function shareTimeline() {    WeixinJSBridge.invoke('shareTimeline',{                            "img_url": imgUrl,                            "img_width": "640",                            "img_height": "640",                            "link": lineLink,                            "desc": descContent,                            "title": shareTitle                            }, function(res) {                            _report('timeline', res.err_msg);                            });}function shareWeibo() {    WeixinJSBridge.invoke('shareWeibo',{                            "content": descContent,                            "url": lineLink,                            }, function(res) {                            _report('weibo', res.err_msg);                            });}// 当微信内置浏览器完成内部初始化后会触发WeixinJSBridgeReady事件。document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {        // 发送给好友        WeixinJSBridge.on('menu:share:appmessage', function(argv){            shareFriend();            });        // 分享到朋友圈        WeixinJSBridge.on('menu:share:timeline', function(argv){            shareTimeline();            });        // 分享到微博        WeixinJSBridge.on('menu:share:weibo', function(argv){            shareWeibo();            });        }, false);</script> </html>