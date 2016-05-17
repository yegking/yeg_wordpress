<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>校跃注册</title>
</head>
<style type="text/css">
.wrapper { width:950px;margin:0 auto; height:auto }
.item { clear:both;margin:0 0 15px;zoom:1; }
#content { min-height:400px;*height:400px; }
#header { padding-top:30px; }
.main { float:left;width:590px; padding-left:20px}
.greeysmall{font-size:12px; color:#CCC}
.small{font-size:12px;}
.aside { float:right;width:310px;color:#666; }
</style>
<?php
/**
 * Template Name: 注册
 * 作者：露兜
 * 博客：http://www.ludou.org/
 *  
 *  2013年02月02日 ：
 *  首个版本
 */
  
if( !empty($_POST['ludou_reg']) ) {
  $error = '';
  $sanitized_user_login = sanitize_user( $_POST['user_login'] );
  $user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

  // Check the username
  if ( $sanitized_user_login == '' ) {
    $error .= '<strong>错误</strong>：请输入用户名。<br />';
  } elseif ( ! validate_username( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：此用户名包含无效字符，请输入有效的用户名<br />。';
    $sanitized_user_login = '';
  } elseif ( username_exists( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：该用户名已被注册，请再选择一个。<br />';
  }

  // Check the e-mail address
  if ( $user_email == '' ) {
    $error .= '<strong>错误</strong>：请填写电子邮件地址。<br />';
  } elseif ( ! is_email( $user_email ) ) {
    $error .= '<strong>错误</strong>：电子邮件地址不正确。！<br />';
    $user_email = '';
  } elseif ( email_exists( $user_email ) ) {
    $error .= '<strong>错误</strong>：该电子邮件地址已经被注册，请换一个。<br />';
  }

  //receive select
	$school=$_POST['select'];  

  // Check the password
  if(strlen($_POST['user_pass']) < 6)
    $error .= '<strong>错误</strong>：密码长度至少6位!<br />';
  elseif($_POST['user_pass'] != $_POST['user_pass2'])
    $error .= '<strong>错误</strong>：两次输入的密码必须一致!<br />';
      
    if($error == '') {
    $user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );


	
    
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
    }
  }
}?>	
<?php if(!empty($error)) {
 echo '<p class="ludou-error">'.$error.'</p>';
}
if (!is_user_logged_in()) { ?>
<body>
<div class="wrapper">
    <div id="header"><a href="#"><img src="images/xiaoyue.png" width="218" height=    "115" /></a>
    </div>
  <div id="content">
    <h1> 欢迎加入校跃</h1>
    <div class="main">
      <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post" enctype="multipart/form-data" name="registerform" id="form1">
	  <div class="item">
        <p>昵　称
          <label for="user_login"></label>
          <input type="text" name="user_login" id="user_login" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" />
        </p>
        </div>
        <div class="item">
        <p>邮　箱
          <label for="user_email"></label>
          <input type="text" name="user_email" id="user_email" value="<?php if(!empty($user_email)) echo $user_email; ?>" />
        </p>
        </div>
         <div class="item">
        <p>密　码
          <label for="user_pwd1"></label>
          <input type="password" name="user_pwd1" id="user_pwd1" />
        </p>
        </div>
		<div class="item">
        <p>重复密码
          <label for="user_pwd2"></label>
          <input type="password" name="user_pwd2" id="user_pwd2" />
        </p>
        </div>
         <div class="item">
        <p>所在大学
          <label for="select"></label>
          <select name="select" id="select">
            <option>电子科技大学</option>
            <option>锦城学院</option>
          </select>
        </p>
        </div>
        <div class="item" style="padding-left:50px">
        <label class="small"> 
          <input type="checkbox" name="checkbox" id="checkbox" />
          我已经认真阅读并同意校跃的《<a href="#">使用协议</a>》。</label>
        </div>
        <div class="item" style="padding-left:50px">
		 <input type="hidden" name="ludou_reg" value="ok" />
        <input name="tj" type="submit" id="tj" value="注册" />
        </div>
      </form>
     <?php } else {
 echo '<p class="ludou-error">您已注册成功，并已登录！</p>';
} ?>
    </div>
            <div class="aside">
            <ul >
            <li class="small">>&nbsp;已经拥有豆瓣帐号?<a href="#"> 直接登录？</a></li>
            <li class="small">>&nbsp;<a href="#">点击下载校跃移动应用</a> </li>
            </ul>
            </div>
    </div>
    
    
</div>
</body>
</html>