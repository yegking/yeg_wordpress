<!DOCTYPE HTML>
<html lang="zh-CN">
<head>

<title>登录校跃</title>
<?php
/**
 * Template Name: 登录
 */
if(!isset($_SESSION))
  session_start();


			if(isset($_POST["tj"])){
				$errors="";
				$validate=$_POST["captcha-solution"];
				unset($_POST["captcha-solution"]);
				$code=$_SESSION["code"];
				unset($_SESSION["code"]);
						if(strcasecmp($validate,$code)!=0){
					//判断session值与用户输入的验证码是否一致;
						  $secure_cookie = false;
						  $errors="验证码错误";
						}
						if(($errors=="")&&isset($_POST['ludou_token']) && ($_POST['ludou_token'] == $_SESSION['ludou_token'])){
							  $secure_cookie = false;
							 $user_name = sanitize_user( $_POST['form_username'] );
							   $user_password = $_POST['form_pwd'];
							  if ( empty($user_name) || ! validate_username( $user_name ) ) {
								$user_name = '';
								   $errors="用户名或密码错误";
							  }
							
							if($errors == "") {
								/* $user_name = sanitize_user( $_POST['form_username'] );
							   $user_password = $_POST['form_pwd'];*/
								//var_dump(force_ssl_admin());
							// If the user wants ssl but the session is not ssl, force a secure cookie.
							if ( !empty($user_name) && !force_ssl_admin() ) {
							  if ( $user = get_user_by('login', $user_name) ) {

								if ( get_user_option('use_ssl', $user->ID) ) {
								  $secure_cookie = true;
								  force_ssl_admin(true);
								}
							  }
							} 
							if ( isset( $_GET['r'] ) ) {
							  $redirect_to = $_GET['r'];
							  // Redirect to https if user wants ssl
							  if ( $secure_cookie && false !== strpos($redirect_to, 'index') )
								$redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
							}
							else {
							  $redirect_to = home_url();//admin_url();
							}
							if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
							  $secure_cookie = false;
							$creds = array();
							$creds['user_login'] = $user_name;
							$creds['user_password'] = $user_password;
							$creds['remember'] = !empty( $_POST['remember'] );
							$user = wp_signon( $creds, $secure_cookie );
							if ( is_wp_error($user) ) {
								$errors="用户名或者密码错误";
							  $errors=  ereg_replace("<a([^>]*)>([^<]*)</a>?", "",$user->get_error_message());
							}
							else {
							  unset($_SESSION['ludou_token']);
							  wp_safe_redirect($redirect_to);
							}
						  }
						   unset($_SESSION['ludou_token']);
					}
					}
					   $remember = !empty( $_POST['remember'] );
						$token = md5(uniqid(rand(), true));
						$_SESSION['ludou_token'] = $token;
?>


<style type="text/css">
/* Reset */
*:focus { outline: none; }
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td { margin:0; padding:0; }
table { border-collapse:collapse; border-spacing:0; }
fieldset,img { border:0; }
address,caption,cite,code,dfn,em,strong,th,var { font-style:normal; font-weight:normal; }
ol,ul { list-style:none; }
caption,th { text-align:left; }
h1,h2,h3,h4,h5,h6 { font-size:100%; font-weight:normal; }
q:before,q:after { content:''; }
abbr,acronym { border:0; }
/* Font,  Link & Container */
body { font:12px/1.6 arial,helvetica,sans-serif; }
a:link { color:#369;text-decoration:none; }
a:visited { color:#669;text-decoration:none; }
a:hover { color:#fff;text-decoration:none;background:#039; }
a:active { color:#fff;text-decoration:none;background:#f93; }
button { cursor:pointer;line-height:1.2; }
.mod { width:100%; }
.hd:after, .bd:after, .ft:after, .mod:after {content:'\0020';display:block;clear:both;height:0; }
.error-tip { margin-left:10px; }
.error-tip, .error { color:#fe2617; }

/* Layout */
.wrapper { width:950px;margin:0 auto; }
#header { padding-top:30px; }
#content { min-height:400px;*height:400px; }
#header, #content { margin-bottom:40px; }
#header, #content, #footer { width:100%;overflow:hidden; }
.article { float:left;width:590px; }
.aside { float:right;width:310px;color:#666; }
.aside li { padding-bottom: 1em; }

.narrow-layout .wrapper { width:90%; }
.narrow-layout h1 { padding-bottom:10px; }
.narrow-layout #header { padding-top:10px;margin-bottom:20px; }
.narrow-layout .article, .narrow-layout .aside { width:auto;float:none;margin-bottom:20px; }
.narrow-layout .aside li { padding:0;margin-bottom:10px; }
.narrow-layout .fright { display:block;float:none; }

/* header */
.logo { float:left; width:244px;  height:145px; overflow:hidden; line-height:10em; }
a.logo:link,
a.logo:visited,
a.logo:hover,
a.logo:active { background:transparent url(data:image/png;base64,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) no-repeat;
}
h1 { color:#de3f33;display:block;font-size:25px;font-weight:bold;line-height:1.1;margin:0;padding:0 0 30px;word-wrap:break-word; }

/* form */
.item { clear:both;margin:0 0 15px;zoom:1; }
label { display: inline-block; float:left; margin-right: 15px; text-align: right; width: 60px; font-size: 14px; line-height: 30px; vertical-align: baseline }
.remember { cursor: pointer; font-size: 12px; display: inline; width: auto; text-align: left; float: none; margin: 0; color: #666 }
.item-captcha input,
.basic-input { width: 200px; padding: 5px; height: 18px; font-size: 14px;vertical-align:middle; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid #c9c9c9 }
.basic-input.small {width:100px;}
.item-captcha input:focus,
.basic-input:focus { border: 1px solid #a9a9a9 }
.item-captcha input { width:100px; }
.item-captcha .pl { color:#666; }
focus {outline: none;}
.btn-submit { cursor: pointer;color: #ffffff;background: #3fa156; border: 1px solid #528641; font-size: 14px; font-weight: bold; padding:6px 26px; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; *width: 100px;*height:30px; }
.btn-submit:hover { background-color:#4fca6c;border-color:#6aad54; }
.btn-submit:active { background-color:#3fa156;border-color:#528641; }
#item-error { padding-left:75px; }
.item-captcha img { max-width:70%; }
body { -webkit-text-size-adjust: none;-webkit-touch-callout: none;-webkit-tap-highlight-color: transparent; }
/* 3rd login*/
.item-3rd { padding:5px 0;width:200px;margin:20px 0 0 75px;border-top:1px solid #eee;border-bottom:1px solid #eee; }
.item-3rd label { width:auto;margin:0;font-size:12px;color:#999;line-height:1.5; }
.item-3rd img { margin:0 5px;vertical-align:middle; }
.item-3rd a:hover { background-color:transparent; }
.item-3rd a:active { background-color:transparent; }
/* sms login */
.item.extra{float:left;}
#post-code-button {float:none;padding-left:200px;width:87px;text-align:right;margin:5px 0;}
#post-code {float:left;width:200px;}
.item-right {text-align:right;width:287px;}
input:-webkit-autofill{-webkit-box-shadow:0 0 0 30px #fff inset;-webkit-text-fill-color:#787878}
</style>


<style type="text/css">
#footer { color:#999;padding-top:6px;border-top: 1px dashed #ddd; }
.fright { float:right; }
.icp { float:left; }
</style>

<script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/jquery-1.7.2.min.js"></script>
<script >
 function changeWindowSize(){var b=document.documentElement;var a=document.getElementById("header").offsetHeight+document.getElementById("content").offsetHeight+document.getElementById("side-nav").offsetHeight;if(b.offsetWidth<=500||b.offsetHeight<=a){if(!changeWindowSize.changed){window.resizeTo(500,a);changeWindowSize.changed=true}b.className="narrow-layout";resizeEvent(true)}else{b.className="";resizeEvent(false)}}
 function resizeEvent(a){if(!a){window.onresize=null;return}window.onresize=(function(){var b;return function(){if(b){window.clearTimeout(b)}b=window.setTimeout(changeWindowSize,100)}})()};
</script>
</head>
<body onload="changeWindowSize()">
<div class="wrapper">
    <div id="header">
      <a href="" class="logo"></a>
  </div>
    <div id="content">
    <h1> 登录校跃</h1>
	<?php

	if (!is_user_logged_in()) { ?>
    <div class="article">
      <form id="form1" name="form1" method="post" onsubmit="return validateForm(this);" autocomplete="off" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
	  <div style="display:none;">
  </div>
    <div id="item-error">
     <?php if(!empty($errors)) {
echo '<p class="error">'.$errors.'</p>';
} ?>
    </div>
        <div class="item"> 
        <label  >账号</label>
        <input name="form_username" type="text" id="username" class="basic-input"  maxlength="60" value="邮箱/用户名" tabindex="1"/>
        </div>
        <div class="item">
        <label>密码</label>
        <input name="form_pwd"  type="password" id="pwd"  class="basic-input"  maxlength="20" tabindex="2"/>
        </div>
 <div class="item item-captcha">
      <label>验证码</label>
      <div>
<img src="http://localhost/myblog/wordpress/index.php/checkcode" onclick="javascript:this.src='http://localhost/myblog/wordpress/index.php/checkcode?tm='+Math.random();"  id="captcha_image" alt="captcha" class="captcha_image"/>
<div class="captcha_block">
  <span id="captcha_block"  class="pl">请输入上图中的字母</span>
  <input type="text" id="captcha_field" name="captcha-solution" tabindex=3  placeholder="验证码" />
</div>
      </div>
    </div>
        <div class="item">
        <p class="remember">　　
        <input type="checkbox" id="remember" name="remember" tabindex="4" value="1" <?php checked($remember); ?>/>
        <label for="remember" class="remember">下次自动登录</label>
          | <a href="#">忘记密码了</a>
       </p>
        </div>
        <div class="item">
        　　　<input type="hidden" name="redirect_to" value="<?php if(isset($_GET['r'])) echo $_GET['r']; ?>" />
             <input type="hidden" name="ludou_token" value="<?php echo $token; ?>" />
        <input type="submit" class="btn-submit" value="登录" name="tj" id="tj" tabindex="5">
        </div>
  
        <div class="item item-3rd">
       <label>第三方登录：</label>
	   <a target="_top" href="https://www.douban.com/accounts/connect/wechat/?from=douban-web&amp;redir=https%3A//www.douban.com/" class="item-wechat"><img src="https://img3.doubanio.com/f/accounts/1b6cc3ca91f78cf47f41eafa91fbcd4918ae239c/pics/connect_wechat.png" title="微信"></a>
  <a target="_top" href="https://www.douban.com/accounts/connect/sina_weibo/?from=douban-web&amp;redir=https%3A//www.douban.com/&amp;fallback=" class="item-weibo"><img src="https://img3.doubanio.com/f/accounts/e2f1d8c0ede93408b46cbbab4e613fb29ba94e35/pics/connect_sina_weibo.png" title="新浪微博"></a>
    </div>
      </form>
    </div>
        <div>
          <ul  id="side-nav" class="aside">
           <li class="small">>&nbsp;还没有校跃帐号？<a href="#">立即注册</a></li>
           <!--<li class="small">>&nbsp;<a href="#">点击下载校跃移动应用</a> </li>-->
        </ul>
        </div>
		 <?php } else {
echo '<p class="ludou-error">您已登录！　　(<a href="'.wp_logout_url( get_permalink()).'" title="登出">退出？</a>)</p>';
} ?>
    </div>
<script>
;(function(e){var d=function(g){return e.getElementById(g)};var f="邮箱/用户名";var b=d("username"),a=d("pwd"),c=d("captcha_field");b.onfocus=function(){if(this.value==f){this.value="";this.style.color="#000"}};b.onblur=function(){if(!this.value){this.value=f;this.style.color="#ccc"}};if(b.value==f){b.style.color="#ccc"}})(document);function trim(a){return a.replace(/^(\s|\u00A0)+/,"").replace(/(\s|\u00A0)+$/,"")}function validateForm(f){var c=0,b=f.elements["captcha-solution"],e=f.elements.form_username,a=f.elements.form_pwd,h=document.getElementById("item-error");if(h){h.style.display="none"}if(b){var g=trim(b.value);if(g===""){displayError(b,"请输入验证码");c=1}else{if(g.length<4){displayError(b,"请输入正确的验证码");c=1}else{clearError(b)}}}if(e){var d=trim(e.value);if(d===""||d==="邮箱/用户名"){displayError(e,"请输入正确的邮箱/用户名");c=1}else{clearError(e)}}if(a){if(a.value===""){displayError(a,"请输入密码");c=1}else{a&&clearError(a)}}return !c}function displayError(a,c){var b=document.getElementById(a.name+"_err");if(!b){b=document.createElement("span");b.id=a.name+"_err";b.className="error-tip";a.parentNode.appendChild(b)}b.style.display="inline";b.innerHTML=c}function clearError(a){var b=document.getElementById(a.name+"_err");if(b){b.style.display="none"}};
</script>

</div>
</body>
</html>