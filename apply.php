<?php
/**还没有产生验证码send_register
 * Template Name: 注册
 * 作者：露兜
 * 博客：http://www.ludou.org/
 *  
 *  2013年02月02日 ：
 *  首个版本
 */
session_start();
if(!empty($_POST['ludou_reg'])){
	//echo $_POST['loc'];
	//print($_SESSION["code"]);
	//echo $_POST['email'];
	if(($_SESSION["name"]==$_POST['name1'])&&($_SESSION["code"]==$_POST['captcha_solution'])){
		unset($_SESSION["email1"]);
		//unset($_SESSION["em"]);
		unset($_SESSION["name"]);
//echo "进来了";
  $error = '';
  $sanitized_user_login = sanitize_user( $_POST['name1'] );

  $user_email = apply_filters( 'user_registration_email', $_POST['email'] );
  	$school=$_POST['select'];  

  // Check the username
  if ( $sanitized_user_login == '' ) {
    $error .= '<strong>错误</strong>：请输入昵称。<br />';
  } elseif ( ! validate_username( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：此昵称包含无效字符，请输入有效的昵称<br />。';
    $sanitized_user_login = '';
  } elseif ( username_exists( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：该昵称已被注册，请再选择一个。<br />';
	}

  // Check the password
  if(strlen($_POST['password']) < 8)
    $error .= '<strong>错误</strong>：密码长度至少8位!<br />';

    if($error == '') {
    $user_id = wp_create_user( $sanitized_user_login, $_POST['password'], $user_email );
	 pft_registration_save( $user_id );
    
    if ( ! $user_id ) {
      $error .= sprintf( '<strong>错误</strong>：无法完成您的注册请求... 请联系<a href=\"mailto:%s\">管理员</a>！<br />', get_option( 'admin_email' ) );
    }
    else if (!is_user_logged_in()) {
      $user = get_userdatabylogin($sanitized_user_login);
      $user_id = $user->ID;
  
      // 自动登录
      wp_set_current_user($user_id, $user_login);
      wp_set_auth_cookie($user_id);
      do_action('wp_login', $user_login);
	  wp_safe_redirect( home_url());
    }
  }
}else{
	 $error="验证码有误";
	}


}
$token = md5(uniqid(rand(), true));
$_SESSION['ludou_token'] = $token;

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>欢迎加入校跃</title>
<style>
html{color:#111;background:#fff}body,div,dl,dt,dd,ul,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,blockquote,p{margin:0;padding:0}table{border-collapse:collapse;border-spacing:0}fieldset,img{border:0}address,caption,cite,code,dfn,em,i,strong,th,var,optgroup{font-style:normal;font-weight:normal}ul,ol{list-style:none}caption,th{text-align:left}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal}q:before,q:after{content:""}abbr,acronym{border:0;font-variant:normal}sup{vertical-align:baseline}sub{vertical-align:baseline}legend{color:#000}input,button,textarea,select,optgroup,option{font-family:inherit;font-size:inherit;font-style:inherit;font-weight:inherit}input,button,textarea,select{*font-size:100%}pre{white-space:pre-wrap;word-wrap:break-word}a{cursor:pointer}a:link{color:#369;text-decoration:none}a:visited{color:#669;text-decoration:none}a:hover{color:#fff;text-decoration:none;background:#039}a:active{color:#fff;text-decoration:none;background:#f93}a img{border-width:0;vertical-align:middle}body,td,th{font:12px Helvetica,Arial,sans-serif;line-height:1.62}table{border-collapse:collapse;border:0;padding:0;margin:0}wbr:after{content:"\00200B"}textarea{resize:none}input[type=text]:focus,input[type=password]:focus,textarea:focus{outline:0}body{-webkit-text-size-adjust:none;-webkit-touch-callout:none;-webkit-tap-highlight-color:transparent}.bn-small,a.bn-cta,.bn-cta input,.bn-flat input{margin:0;border:0;background:transparent;cursor:pointer;-webkit-appearance:none}.lnk-flat,.bn-flat{display:inline-block;*display:inline;zoom:1;overflow:hidden;vertical-align:middle;color:#444;border-width:1px;border-style:solid;border-color:#bbb #bbb #999;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}.lnk-flat,.bn-flat input{height:2.1em;padding:0 1.16em 2px;line-height:2.2;*line-height:2.3;font-size:12px;cursor:pointer;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;background:url(https://img3.doubanio.com/f/accounts/23850eee993fea8be43be857dcbaa23961de56aa/pics/bn_ie_bg.png) repeat-x top;background-image:-webkit-gradient(linear,left top,left bottom,from(#fcfcfc),to(#e9e9e9));background-image:-webkit-linear-gradient(top,#fcfcfc,#e9e9e9);background-image:-moz-linear-gradient(top,#fcfcfc,#e9e9e9);background-image:-ms-linear-gradient(top,#fcfcfc,#e9e9e9);background-image:-o-linear-gradient(top,#fcfcfc,#e9e9e9);background-image:linear-gradient(top,#fcfcfc,#e9e9e9)}.lnk-flat:hover,.bn-flat input:hover,.bn-flat-over{color:#333;border-color:#999 #999 #666;background-color:transparent;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f8f8f8',endColorstr='#dddddd',GradientType=0);background-image:-webkit-gradient(linear,left top,left bottom,from(#f8f8f8),to(#ddd));background-image:-webkit-linear-gradient(top,#f8f8f8,#ddd);background-image:-moz-linear-gradient(top,#f8f8f8,#ddd);background-image:-ms-linear-gradient(top,#f8f8f8,#ddd);background-image:-o-linear-gradient(top,#f8f8f8,#ddd);background-image:linear-gradient(top,#f8f8f8,#ddd)}.lnk-flat:active,.bn-flat input:active,.bn-flat-active input{color:#333;border-color:#999 #999 #666;background:#ddd}.lnk-flat{line-height:2.2em}.lnk-flat:link,.lnk-flat:visited{text-decoration:none}a.bn-cta,.bn-cta input{display:inline-block;padding:4px 20px;border:1px solid #528641;background:#3fa156;color:#fff;font-size:14px;letter-spacing:2px;*position:relative;*display:inline;zoom:1;*padding:6px 20px 4px;*line-height:1.2;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}a.bn-cta{vertical-align:middle}.bn-cta input{padding:5px 18px;*padding:4px 10px 2px;*vertical-align:middle}a.bn-cta:link,a.bn-cta:visited{color:#fff}.bn-cta input:hover,a.bn-cta:hover{background-color:#4fca6c;border-color:#6aad54}.bn-cta input:active,a.bn-cta:active{background-color:#3fa156;border-color:#528641}.bn-small{padding:1px 2px;border:1px solid #ffabab;color:#ff7676;background:#fdd;height:1.5em\9;line-height:1.56;*line-height:1.4;*position:relative;-webkit-appearance:none;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}a.bn-small:link,a.bn-small:visited,a.bn-small:hover,a.bn-small:active{padding:0 4px;line-height:1.8;font-size:12px;*line-height:1.3;zoom:1;*height:13px;*overflow:hidden;color:#ff7676;background:#fdd}a.bn-small:hover,a.bn-small:active{border-color:#ff7676;background-color:#ff7676;color:#fdd}.recsubmit .bn-flat{margin:0 10px}.basic-input,.basic-textarea{padding:5px;height:18px;font-size:14px;vertical-align:middle;border:1px solid #c9c9c9;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.basic-input:focus,.basic-textarea:focus{border:1px solid #a9a9a9}.disabled-input{background:#eee;color:#999}.basic-textarea{height:auto}ul,ol{margin:0;padding:0}.wrapper,.header,.footer{width:950px;margin:0 auto 40px;overflow:hidden;zoom:1}.header{margin-bottom:40px}.article{float:left;width:590px;margin-right:50px}.aside{color:#666;overflow:hidden;zoom:1}.aside h2{font-size:15px;color:#072;margin:0 0 12px 0;line-height:150%}.single-nav{padding-top:30px}.sidenav{margin-top:1em}.sidenav li{margin-bottom:1em}h1{display:block;margin:0;padding:0 0 15px 0;font-size:25px;font-weight:bold;color:#494949;line-height:1.1}p{margin:1em 0}.site-nav-logo a:hover{background:0}
</style>
<style>
a { color: #336699 }
em { font-style: normal }
form { position: relative; left: 0; top: 0 }
.item { clear:both;margin: 15px 0 }
.item-error { margin-left: 75px; color: #fe2617 }
.suggestion { padding-left: 75px }
.article { padding-bottom: 1em; }
label { display: inline-block; float:left; margin-right: 15px; text-align: right; width: 60px; font-size: 14px; line-height: 30px; vertical-align: middle }
p.agreement { margin-left: 75px; }
.agreement-label { display: inline; width: auto; text-align: left; float: none }
.box { margin-left: 75px }
.basic-input { width: 200px; padding: 5px; height: 18px; font-size: 14px; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid #c9c9c9 }
.item .basic-input:focus { border: 1px solid #a9a9a9 }
.validate-option { display: none; color: #808080 }
.validate-error { display: none; color: #fe2617 }
p.validate-error { margin-left: 75px }
.loc-item .validate-error { line-height: 30px }
.extra-tips .validate-error , .extra-tips .validate-option { padding-left: 10px; background: url(<?php bloginfo('template_directory')?>/images/tips_arrow.gif) no-repeat}
.extra-tips .validate-error { background-position: left -52px }
.extra-tips .validate-option { background-position: left 4px }
.loc { font-size: 12px; line-height: 30px }
.tips , #location , .agreement-label { font-size: 12px; color: #808080 }
#location strong { color: #111111; font-weight: normal }
.captcha-item span.validate-error { padding-left: 10px; background: url(<?php bloginfo('template_directory')?>/images/tips_arrow.gif) no-repeat left -52px ; display: none }
.captcha-img { margin: 2px 6px 0 0; vertical-align: top }
.captcha-item label { height: 90px }
.captcha-item .basic-input { width: 95px }
.captcha-item { zoom: 1 }
.agreement input , .agreement label { cursor: pointer }
.agreement-label { color: #000 }
#email_suggestion { display: inline-block; position: absolute; left: 75px; top: 70px; _left: 0px }
#email_suggestion p { background: #eef9eb; border: 1px solid #5e5e5f; margin: 0; padding: 3px }
.btn-submit { cursor: pointer; font-size: 14px; font-weight: bold; padding: 6px 26px; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; *width: 100px }
.disabled { color: #999; background: #f0f0f0; border: 1px solid #b9b9b9 }
.enabled { color: #ffffff; background: #3fa156; border: 1px solid #528641 }
.device-mobile .captcha-img { display:block;max-width:60%; }
.device-mobile .captcha-item p { margin-bottom:1em; }
.device-mobile .item-submit { margin-bottom:2em;  }

#request-phone-code-btn { cursor: pointer;background: #fff;border: 1px solid #c9c9c9;font-size: 13px;padding: 6px 15px;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px;vertical-align: middle; }

#captcha_dialog input[name="captcha-solution"]{padding:5px;width:238px;height:25px;border:1px solid #c9c9c9;border-radius:3px;vertical-align:middle;font-size:22px}#captcha_dialog input[type="button"]{height:2.1em;padding:0 1.16em 2px;border:1px solid #c9c9c9;border-radius:3px;background:transparent}#captcha_dialog input#captcha{width:200px}#captcha_dialog .captcha-img{width:210px;cursor:pointer;margin:0}#captcha_dialog .bd{text-align:center}#captcha_dialog .ft .bn-flat input{font-weight:bold;margin:0}
</style>

 <style type="text/css">
#footer { color:#999;padding-top:6px;border-top: 1px dashed #ddd; }
.fright { float:right; }
.icp { float:left; }
p.ludou-error {
  margin: 16px 0;
  padding: 12px;
  background-color: #ffebe8;
  border: 1px solid #c00;
  font-size: 12px;
  line-height: 0.1em;
}
</style>



<!--<script type="text/javascript" src="https://img3.doubanio.com/f/accounts/4ff6b04bf980286a3aef551db4adbf73a937e01b/js/lib/cookie.js"></script>-->
  <script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/do.js" data-cfg-corelib="<?php bloginfo('template_directory')?>/js/jquery-1.7.2.min.js"></script>
<script>
Do.add('dialog-css', {path: '<?php bloginfo('template_directory')?>/dialog.css', type: 'css'});
Do.add('dialog', {path: '<?php bloginfo('template_directory')?>/js/dialog.js', type: 'js', requires: ['dialog-css']});
Do.add('validate', {path: '<?php bloginfo('template_directory')?>/js/validate.js', type: 'js'});
</script>


</head>

<?php if(!empty($error)) {
 echo '<p class="ludou-error">'.$error.'</p>';
}
if (!is_user_logged_in()) { ?>
<body>
    <div class="header">
      
<div id="header">
  <div class="site-nav single-nav">
    <div class="site-nav-logo">
      <a href="">
          <img src="<?php bloginfo('template_directory')?>/images/1234.png" alt="校跃">
      </a>
    </div>
  </div>
</div>

    </div>
    
  <div class="wrapper">
    
<h1>
欢迎加入校跃
</h1>

    <div class="article">
    <form name="lzform" method="post"  action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
        <div style="display:none;">
            <input type="hidden" name="source" value="simple"/>
        </div>
		 <div class="item extra-tips">
            <label>昵称</label>
            <input id="name" name="name1" type="text" class="basic-input" maxlength="15" tabindex="1" value=""/>
        </div>
        <div class="item extra-tips">
            <label>密码</label>
            <input id="password" name="password" type="password" class="basic-input" tabindex="2" maxlength="20"/>
        </div>
		<div class="suggestion">
            <div id="email_suggestion"></div>
        </div>

		<div class="item loc-item">
                <label>学校</label>
                <span class="loc">
                <em id="location">校跃猜你在<strong>电子科技大学成都学院</strong>，没猜对？</em> <a href="#" class="a-btn-location" id="edloc">手动选择</a>
                </span>
                
                <input type="hidden" name="loc" value="1011"/>
            </div>

        <div class="item extra-tips">
            <label>邮箱</label>
            <input id="email" name="email" type="text" class="basic-input" maxlength="60" tabindex="3" value=""/>
        </div>
        <div class="suggestion">
            <span class="tips">邮箱用于找回密码</span>
        </div>

           


       
       
        <div class="item captcha-item">
            <label>验证码</label>
            <!--<input id="code" name="code" type="text" class="basic-input small" maxlength="10" tabindex="5"/>-->
            <input id="request-phone-code-btn" type="submit" value="点击输入验证码"/>
            <span id="tips-error" class="tips"><em></em></span>
            <span id="tips-info" class="tips"></span>
            <span class="validate-error" id="frm_error"></span>
        </div>

        <div class="item">
          <p class="agreement">
            <label for="agreement" class="agreement-label">
              <input type="checkbox" id="agreement" name="agreement" tabindex="5"
                />
              我已经认真阅读并同意校跃的《<a target="_blank" href="/about?policy=agreement">使用协议</a>》。
            </label>
          </p>
        </div>
        <div class="item-submit">
            <label>&nbsp;</label>
            <input type="submit" name="register" value="注册" disabled="disabled" id="button" class="btn-submit disabled" tabindex="6" title="阅读并同意校跃的《使用协议》方可注册。"/>
        </div>
		 <input type="hidden" name="ludou_reg" value="ok" />
    </form>



 

    </div>
    <div class="aside">
      
<ul class="sidenav">
  <li>&gt;&nbsp;已经拥有校跃帐号? <a rel="nofollow" href="/login">直接登录</a></li>


</ul>

    </div>
  </div>
  	  <?php } else {
 echo '<p class="ludou-error">您已注册成功，并已登录！</p>';
} ?>

    <div class="footer">
      
<div id="footer">


<span id="icp" class="fleft gray-link">
    &copy; 2016 yegking.com, all rights reserved
</span>

<span class="fright">
    <a href="https://www.douban.com/about">关于校跃</a>
    · <a href="https://www.douban.com/jobs">在校跃工作</a>
    · <a href="https://www.douban.com/about?topic=contactus">联系我们</a>
    · <a href="https://www.douban.com/about?policy=disclaimer">免责声明</a>
    
    · <a href="https://www.douban.com/help/">帮助中心</a>
    · <a href="https://developers.douban.com/" target="_blank">开发者</a>
    · <a href="https://www.douban.com/mobile/">移动应用</a>
    · <a href="https://www.douban.com/partner/">校跃广告</a>
</span>




</div>

    </div>
    <!-- main -->
    <!-- COLLECTED JS -->
    

<script>

Do('dialog', function(){

    (function(){var e,g,f,c,b="captcha_dialog",a="http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/reg_captcha.php";function h(){$.getJSON(a,function(j){f.attr("src",j.url);g.val(j.token)});captcha_solution_el.val("")}function d(){if(e!==undefined){e.updateSize();e.updatePosition()}}function i(k,j){if(e!==undefined){e.open();h();captcha_solution_el.val("");captcha_solution_el.focus();return}e=dui.Dialog({title:"请输入下图中的字母",url:a,nodeId:b,modal:true,width:340,cache:false,dataType:"json",buttons:[{cls:"confirm-btn",text:"确定",method:function(){var m=g.val().trim(),l=captcha_solution_el.val().trim();if(l){e.close();k(m,l)}}}],callback:function(){$.getJSON(a,function(l){e.setContent('                        <div class="captcha-item">                            <input type="hidden" value="'+l.token+'" name="captcha-id">                            <img src="'+l.url+'" class="captcha-img"/>                             <input type="text" name="captcha-solution" class="basic-input captcha" id="captcha" maxlength="10"/>                        </div>');g=e.node.find("input[name='captcha-id']");f=e.node.find("img.captcha-img");captcha_solution_el=e.node.find("input[name='captcha-solution']");c=e.node.find(".confirm-btn input");f.one("load",function(){d()}).each(function(){if(this.complete){$(this).load()}});captcha_solution_el.keypress(function(m){if(m.which==13){m.preventDefault();c.click()}});f.click(h);d();captcha_solution_el.focus()});e.btnClose.click(function(){if(j!==undefined){j()}})}},true);e.open()}window.show_captcha_dialog=i})();

    var need_captcha_test = true;

    $('#request-phone-code-btn').click(function(e) {
        e.preventDefault();
        request_phone_code();
    });

    function request_phone_code(captcha_id, captcha_solution){
        $('#tips-error em').text('')
        var i = 60, num = $.trim($("#email").val());
		var e = $('#email').parents('.item').hasClass('has-error');
		//window.alert(e);

        /*if(num === ""||e==true) {
            displayError($("#request-phone-code-btn")[0], "请输入正确的邮箱");
            return;
        }*/
        var data = { phone: num},
            el = $('#request-phone-code-btn');;
        if (need_captcha_test){
            if (captcha_id === undefined) {
                setTimeout(function() {show_captcha_dialog(request_phone_code, function(){
                    $('#tips-info').text('');
                });}, 0)
                return
            } else {
                data.captcha_id = captcha_id;
                data.captcha_solution = captcha_solution;
            }
        }
		$("#_err").text('');
        $('#tips-info').text('请稍等...');
        $.post('http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/send_register_verify_code.php', data, function(result) {
			window.alert(result.r);
			window.alert(captcha_solution_el.val());
            if (result.r === 0) {
                /*el.attr('disabled', 'disabled');
                var timer = setInterval(function () {
                    el.val('重新获取' + ' (' + --i + ')');
                    if (!i) {
                        clearInterval(timer);
                        el.removeAttr("disabled").val('获取验证码');
                    }
                }, 1000);*/
				$("#_err").text('');
               // $('#tips-info').text('邮箱验证码已发送(没有?请点垃圾箱查看或换个邮箱)');
			   $('#tips-info').text('验证码输入正确');
            } else {
                if (result.reason === 'captcha_required'){
                    need_captcha_test = true;
                    setTimeout(function() { request_phone_code(); }, 0)
                    return
                } else {
						$("#_err").text('');
                    $('#tips-error em').text('验证失败，请稍后再试');
                }
                $('#tips-info').text('');
            }
        }, 'json');
    }
});

$("form .change-captcha-btn").on('click', function(){
    var captcha_id_el = $('form input[name="captcha-id"]'),
        captcha_img_el = $('form img.captcha-img'),
        captcha_url = 'http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/reg_captcha.php';
    $.getJSON(captcha_url, function(captcha) {
        captcha_img_el.attr("src", captcha.url);
        captcha_id_el.val(captcha.token);
    });
});

function displayError(el, msg) {
  var err = document.getElementById(el.name + '_err');
  if (!err) {
    err = document.createElement('span');
    err.id = el.name + '_err';
    err.className = 'error-tip';
    el.parentNode.appendChild(err);
  }
  err.style.display = 'inline';
  err.innerHTML = msg;
}


Do('validate','dialog',function(){
    var email = $('#email'),
        suggestion = $('#email_suggestion'),
        email_value = '',
        e_name = '',
        e_domain = '',
        e_tip_on = 0,
        passwd_reg = /^[\u4e00-\u9fa5]/,

        email_list = new Array('163.com','126.com', '139.com', '188.com', '2008.china.com', '2008.sina.com', '21cn.com', '263.net', 'china.com', 'chinaren.com', 'citiz.net', 'eyou.com', 'foxmail.com', 'gmail.com', 'hongkong.com', 'hotmail.com', 'live.cn', 'live.com', 'mail.china.com', 'msn.com', 'my3ia.sina.com', 'qq.com', 'sina.cn', 'sina.com', 'sina.com.cn', 'sogou.com', 'sohu.com', 'vip.163.com', 'vip.qq.com', 'vip.sina.com', 'vip.sohu.com', 'vip.tom.com', 'yahoo.cn', 'yahoo.com', 'yahoo.com.cn', 'yahoo.com.hk', 'yahoo.com.tw', 'yeah.net'),

        TXT_CAPTCHA_NULL = '请输入验证码',
        TXT_CAPTCHA_ERROR = '请输入正确的验证码',
        error_info = $('#frm_error').text();

        if ( error_info === TXT_CAPTCHA_NULL || error_info === TXT_CAPTCHA_ERROR ) {
            $('#frm_error').show();
        } else {
            $('<div></div>').text(error_info).addClass('item-error').insertAfter('.captcha-item').show();
            $('#frm_error').remove();
        }

    function DPA(s1, s2){
        var m = new Array();
        var i, j;
        for(i=0; i < s1.length + 1; i++) m[i] = new Array(); // i.e. 2-D array

        m[0][0] = 0; // boundary conditions

        for(j=1; j <= s2.length; j++)
            m[0][j] = m[0][j-1]-0 + 1; // boundary conditions

        for(i=1; i <= s1.length; i++)                            // outer loop
        {
            m[i][0] = m[i-1][0]-0 + 1; // boundary conditions

            for(j=1; j <= s2.length; j++)                         // inner loop
            {
                var diag = m[i-1][j-1];
                if( s1.charAt(i-1) != s2.charAt(j-1) ) diag++;

                m[i][j] = Math.min( diag,               // match or change
                Math.min( m[i-1][j]-0 + 1,    // deletion
                m[i][j-1]-0 + 1 ) ); // insertion
            }//for j
        }//for i
       return m[s1.length][s2.length];
    };

    function get_like(s){
        r = 0;
        v = s.split('@');
        if ( v.length <=1 ) return;
        domain = v[1];
        e_name = v[0];
        dis = domain.length;
        for (k=0; k < email_list.length; k++){
            e = email_list[k];
            d = DPA(domain, e);
            if (d < dis){
                dis = d;
                e_domain = e;
            }
        }
        if(dis && dis < 4){
            r = 1;
        }
        return r;
    };

    function email_suggestion(like){
        s = email.attr('value');
        if (!( s && s.length > 2 )) {
            return;
        }
        if (like && get_like(s)){
            as = ' <a id="yes_but" href="#">是</a>／<a href="#" id="no_but">不是</a>';
            suggestion.html( '<p><span>你是否要输入' + e_name + '@</span>' + e_domain + as + '</p>' );
            $("#yes_but").focus();
            e_tip_on = 1;
        }

        email_value = email.attr('value');
        return r;
    };

    $('#email').focusout(function() {
        var e = $(this).parents('.item').hasClass('has-error');
        if ( !e ) {
            email_suggestion(1);
        }
    });

    $('body').delegate('#yes_but', 'click', function(e) {
        e.preventDefault();
        email.attr('value', e_name + '@' + e_domain);
        email.focus();
        suggestion.html( '' );
        e_tip_on = 0;
    });
    $('body').delegate('#no_but', 'click', function(e) {
        e.preventDefault();
        suggestion.html( '' );
        e_tip_on = 0;
    });
    $("input[name='agreement']").each(function(){
        if ($("input[name='agreement']").is(':checked')) {
            $("input[name='register']").attr('disabled', false).addClass('enabled');
        } else {
            $("input[name='register']").attr('disabled', true).removeClass('enabled');
        }
    });
    $("input[name='agreement']").click(function(){
        if ($("input[name='agreement']").is(':checked')) {
            $("input[name='register']").attr('disabled', false).addClass('enabled');
        } else {
            $("input[name='register']").attr('disabled', true).removeClass('enabled');
        }

    });
    var optionMsg = {
        email: '用来登校跃，接收到激活邮件才能完成注册',
        password: '至少包含字母和数字，最短8个字符，区分大小写',
        name1: '中、英文均可，最长14个英文或7个汉字',
        loc: ''
    },
    validateError = {
        email: {
            isNull: 'Email不能为空',
            invalidFormat: 'Email格式不正确',
            //unavailable: '',
            unableForTom: '目前暂时不支持使用 tom.com 邮箱注册校跃帐号',
            unableForChongseo: '目前暂时不支持使用 chongseo.cn 邮箱注册校跃帐号'
        },
        password: {
            isNull: '密码不能为空',
            isShort: '密码长度不足8个字符',
            invalidFormat: '请使用英文字母、符号或数字',
            invalidStrong: '密码强度不够，请包含字母和数字'
        },
        location: {
            isNull: '常居地不能为空'
        },
        name: {
            isNull: '名号不能为空',
            isLong: '名号长度不能超过14个英文或7个汉字'
        },
        captcha: {
            isNull: '验证码不能为空'
        }
    },
    validateRules = {
        email: {
            elems: 'input[name=email]',
            isNull: function(el) {
                return !$.trim(el.val());
            },
            invalidFormat: function(el) {
                  return !$.validate.isEmail($.trim(el.val()));
            },
            unavailable: function(el,o) {
                var item = el.parents('.item');
                o.asyncValidate(el,
                "<?php echo home_url()?>/index.php/is_registered?email=" + $.trim(el.val()),
                function(j){
                    if (j.ok){
                        el.val(s);
                        o.displayError(el, '该Email已经注册过');
                        item.addClass('has-error');
                    }
                });
            },
            unableForTom: function(el,o) {
                var domain = el.val().split('@')[1];
                return domain == 'tom.com';
            },
            unableForChongseo: function(el,o) {
                var domain = el.val().split('@')[1];
                return domain == 'chongseo.cn';
            }

        },
        password: {
            elems: 'input[name=password]',
            isNull: function(el) {
                if ( el.val() === '' ) return true;
            },
            isShort: function(el) {
                if ( el.val() !='' && el.val().length < 8 ) {
                    return true;
                }
            },
            invalidFormat: function(el) {
                var s = $.trim(el.val());
                return passwd_reg.test(s);
            },
            invalidStrong: function(el) {
                var s = $.trim(el.val());
                if (!(/\d/.test(s))){
                    return true;
                }
                if (!(/[a-zA-Z\~\)\!\$\%\*\(\_\+\-\=\{\}\[\]\|\:\;\<\>\?\,\.\/\@\#\^\"\'\`\?\&]/.test(s)))
                {
                    return true;
                }
            }
        },
        name: {
            elems: 'input[name=name1]',
            isNull: function(el) {
                return !$.trim(el.val());
            },
            isLong: function(el) {
                return $.trim(el.val()).replace(/[^\x00-\xff]/g, '校跃').length <= 14 ? false : true;
            },
				unavailable: function(el,o) {
                var item = el.parents('.item');
                o.asyncValidate(el,
                "<?php echo home_url()?>/index.php/is_name?username=" + $.trim(el.val()),
                function(j){
                    if (j.ok){
						 var s = $.trim(el.val());
                        el.val(s);
                        o.displayError(el, '该用户名已注册');
                        item.addClass('has-error');
                    }
					 if (j.ok==2){
                        el.val(s);
                        o.displayError(el, '该用户名包含无效字符');
                        item.addClass('has-error');
                    }
                });
            }
        },
        location: {
            elems: 'input[name=loc]',
            isNull: function(el) {
                return !$.trim(el.val());
            }
        },
        captcha: {
            elems: 'input[name=captcha-solution]',
            isNull: function(el) {
                return !$.trim(el.val());
            }

        }
    };
    $('form').validateForm(validateRules, validateError, optionMsg, null);
	
	

    String.prototype.strReverse=function(){var b="";for(var a=0;a<this.length;a++){b=this.charAt(a)+b}return b};function checkPassword(f){if(!f){return 0}var h=8;if(f.length<h){return 0}var g=0;var e="abcdefghijklmnopqrstuvwxyz";var d="01234567890";var a="~)!@#$%^&*()_+-={}[]|:;<>?,./";if(f.length>=10){g+=20}if(f.length>=12){g+=20}if(f.match(/[a-z]/g)){g+=20}if(f.match(/[0-9]/g)){g+=20}if(f.match(/[A-Z]/g)){g+=20}for(var i=0;i<a.length;i++){if(f.indexOf(a[i])!=-1){g+=20;break}}for(var i=0;i<23;i++){var b=e.substring(i,parseInt(i+3));var c=b.strReverse();if(f.indexOf(b)!=-1||f.indexOf(c)!=-1){g-=20}b=e.toUpperCase().substring(i,parseInt(i+3));c=b.strReverse();if(f.indexOf(b)!=-1||f.indexOf(c)!=-1){g-=20}}for(var i=0;i<8;i++){var b=d.substring(i,parseInt(i+3));var c=b.strReverse();if(f.indexOf(b)!=-1||f.toLowerCase().indexOf(c)!=-1){g-=20}}return Math.max(g,0)};

    var delayKey,
    displayPasswdMeter = function(n, item) {
      var s,  node = item.find('.validate-meter');

      if (n < 60) {
        s = '弱';
      } else if (n < 80) {
        s = '一般';
      } else {
        s = '强';
      }

      item.find('.validate-option, .validate-error').hide();

      if (node.length === 0) {
        node = $('<span class="validate-meter"></span>').appendTo(item);
      }

      node.show().text('密码强度：' + s);
    };

    $('#password').bind({
      focus: function() {
        var el = $(this),
        item = el.parent();

        if (item.find('.validate-error').css('display') === 'inline') {
          return;
        }

        if (el.val().length >= 8) {
          item.find('.validate-option').hide();
        }
      },

      blur: function() {
        var el = $(this),
        item = el.parent(),
        error = item.find('.validate-error');

        if (error.css('display') === 'inline') {
          item.find('.validate-meter').hide();
          return;
        }
      },

      keyup: function(e) {
        var el = this;
        if (this.value.length < 8) {
          return;
        }
        delayKey && clearTimeout(delayKey);
        delayKey = setTimeout(function(){
          displayPasswdMeter(checkPassword(el.value), $(el).parent());
        }, 10);
      }
   });
});
</script>


<script>
;(function(){
Do.add('dialog-css',{path: 'http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/accounts/dialog.css',type:'css'});
Do.add('dialog',{path: 'http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/accounts/dialog.js',type:'js',requires:['dialog-css']});
Do('dialog',function(){
var where = 'register';
var dlg=dui.Dialog();dlg.set({title:"选择你的学校",url:"http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/school.html",width:(/device-mobile/i).test(document.documentElement.className)?document.documentElement.offsetWidth*0.9:560,cache:true,callback:function(a,b){$(".selected .loc-type").each(function(){getLocations($(this))});$("body").delegate("a.habitable","click",function(c){c.preventDefault();if(where=="register"){$("#l_tabs").nextAll(".loading").show();$("input[name='loc']").val($(this).attr("id"));$("em#location").html("<strong>"+$(this).text()+"</strong>");$("em#location").next().html("重新选择");b.close();$(".loc-item .validate-error").hide()}else{$.post("https://www.douban.com/j/location/move",{loc:$(this).attr("i"),ck:get_cookie("ck")},function(d){if(d.r){b.close();window.location.reload()}else{alert("请求失败，请重试。")}})}});$("body").delegate("a.unhabitable, a.loc-type","click",function(f){f.preventDefault();var d=$.trim($(this).attr("id")).substring($.trim($(this).attr("id")).indexOf("_")+1);var c="#p_"+d;$("#l_tabs").nextAll(".loading").show();if($(this).hasClass("unhabitable")){getChildren($(this))}if($(this).hasClass("loc-type")){getLocations($(this))}$(this).parent().siblings("li.selected").removeClass("selected");$(this).parent().addClass("selected");$(c).siblings("div").remove();dlg.updateSize();dlg.updatePosition()})}});function getLocations(f){var e=f.attr("id");var c=$.trim(e).substring($.trim(e).indexOf("_")+1);var d="http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/schools/"+c;var b="p_"+c;var g=$("<div></div>").insertAfter(f.parent().parent()).attr("id",b);var a=$("<ul></ul>").appendTo(g).wrapAll("<div></div>");a.parent().addClass("panel");$.getJSON(d,function(i){$("#l_tabs").nextAll(".loading").hide();$.each(i.locations,function(k,j){var l=$('<a href="#"></a>');if(!j.habitable){l.addClass("unhabitable")}else{l.addClass("habitable")}l.text(j.name).attr({id:j.id,title:j.population+"人"}).appendTo(a).wrapAll("<li></li>");if(j.population<=100){l.parent().hide().addClass("off")}});$("<li></li>").css({display:"block",height:"10px"}).insertBefore(a.children("li.off:first"));if(a.children(".off").length){var h=$("<p></p>").addClass("expand");h.appendTo(a);$("<a></a>").appendTo(h).text("更多")}dlg.updateSize();dlg.updatePosition()})}function getChildren(f){var e=f.attr("id");var c=$.trim(e).substring($.trim(e).indexOf("_")+1);var d="http://localhost/myblog/wordpress/wp-content/themes/Qingart/a/schools/"+c;var b="p_"+c;var g=$("<div></div>").insertAfter(f.parent().parent()).attr("id",b);var a=$("<ul></ul>").appendTo(g).wrapAll("<div></div>");a.parent().addClass("panel");$.getJSON(d,function(h){$("#l_tabs").nextAll(".loading").hide();$.each(h.locations,function(k,j){if(!j.has_child){alert("此地区不能作为常居地，请选择其他城市");g.remove();return false}$.each(j.children,function(m,l){var n=$('<a href="#"></a>');if(!l.habitable){n.addClass("unhabitable")}else{n.addClass("habitable")}n.text(l.name).attr({id:l.id,title:l.population+"人"}).appendTo(a).wrapAll("<li></li>")})});dlg.updateSize();dlg.updatePosition()})}$("body").delegate("p.expand a","click",function(a){a.preventDefault();$("li.off").show().addClass("on").removeClass("off");$(this).text("收起").parent().removeClass("expand").addClass("contract");dlg.updateSize();dlg.updatePosition()});$("body").delegate("p.contract a","click",function(a){a.preventDefault();$("li.on").hide().addClass("off").removeClass("on");$(this).text("更多").parent().removeClass("contract").addClass("expand");dlg.updateSize();dlg.updatePosition()});$("#edloc,#btnLocation").click(function(a){a.preventDefault();$(".loading").hide();dlg.open();dlg.updateSize();dlg.updatePosition()});
});
})();
</script>

<style type="text/css">
/* for pop dialog */
.loading { font-size: 14px; margin: 12px; color: #888; background-position: left center; padding: 0 0 0 20px; float: none; width: auto; height: auto }
#l_tabs li { display: inline-block; padding: 0px 12px }
#l_tabs li { *display: inline }
.selected { background: #93b77b;  border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; color: #ffffff }
.selected a, .selected a:link { color: #fff!important; background: none; cursor: default; }
.panel ul { border-top: 1px solid #cccccc; padding: 12px 0 0 12px; margin: 10px 0 }
.panel a { font-size: 14px }
.panel ul li { display: inline-block; padding: 0 3px ; margin-right: 15px }
.panel ul li { *display: inline }
.off { display: none }
.panel li.on , .panel li.off { margin-right: 8px }
.panel li.on a , .panel li.off a { font-size: 12px; line-height: 15px }
.expand , .contract { margin: 0; text-align: right; padding-right: 10px }
.panel .expand a , .panel .contract a { font-size: 12px }
.panel .expand { background: url(https://img3.doubanio.com/f/shire/479b9d6dcc35cd548d9cd1a2d826f23213f5868c/pics/icon/tongcheng_tab_down.gif) no-repeat right 2px }
.panel .contract { background: url(https://img3.doubanio.com/f/shire/0badd8bb59652acb2f2823388150bdf1c02502f8/pics/icon/tongcheng_tab_up.gif) no-repeat right 2px }
</style>

</body>
</html>
