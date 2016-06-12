<?php
/**
 * Template Name: test
 * 作者：露兜
 * 博客：http://www.ludou.org/
 *  
 *  2013年5月6日 ：
 *  首个版本
 *  
 *  2013年5月21日 ：
 *  防止刷新页面重复提交数据
 */
  
if(!isset($_SESSION))
  session_start();
  	echo 1;
				var_dump($_POST['ludou_token']);
					echo 5;
							var_dump($_SESSION['ludou_token']);
								var_dump(($_POST['ludou_token'] == $_SESSION['ludou_token']));
if( isset($_POST['ludou_token']) && ($_POST['ludou_token'] == $_SESSION['ludou_token'])) {
  $error = '';
  $secure_cookie = false;
  $user_name = sanitize_user( $_POST['log'] );
  $user_password = $_POST['pwd'];
  if ( empty($user_name) || ! validate_username( $user_name ) ) {
    $error .= '<strong>错误</strong>：请输入有效的用户名。<br />';
    $user_name = '';
  }
  
  if( empty($user_password) ) {
    $error .= '<strong>错误</strong>：请输入密码。<br />';
  }
  
  if($error == '') {
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
      if ( $secure_cookie && false !== strpos($redirect_to, 'wp-admin') )
        $redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
    }
    else {
      $redirect_to = admin_url();
    }
    
    if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
      $secure_cookie = false;
    
    $creds = array();
    $creds['user_login'] = $user_name;
    $creds['user_password'] = $user_password;
    $creds['remember'] = !empty( $_POST['rememberme'] );
    $user = wp_signon( $creds, $secure_cookie );
    if ( is_wp_error($user) ) {
      $error .= $user->get_error_message();
    }
    else {
      unset($_SESSION['ludou_token']);
      wp_safe_redirect($redirect_to);
    }
  }

  unset($_SESSION['ludou_token']);
}

$rememberme = !empty( $_POST['rememberme'] );
  echo 4;
							var_dump($_SESSION['ludou_token']);
$token = md5(uniqid(rand(), true));
$_SESSION['ludou_token'] = $token;
?>
<?php if(!empty($error)) {
echo '<p class="ludou-error">'.$error.'</p>';
}
if (!is_user_logged_in()) { ?>
<form name="loginform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="ludou-login">
    <p>
      <label for="log">用户名<br />
        <input type="text" name="log" id="log" class="input" value="<?php if(!empty($user_name)) echo $user_name; ?>" size="20" />
      </label>
    </p>
    <p>
      <label for="pwd">密码(至少6位)<br />
        <input id="pwd" class="input" type="password" size="25" value="" name="pwd" />
      </label>
    </p>
    
    <p class="forgetmenot">
      <label for="rememberme">
        <input name="rememberme" type="checkbox" id="rememberme" value="1" <?php checked( $rememberme ); ?> />
        记住我
      </label>
    </p>
    
    <p class="submit">
      <input type="hidden" name="redirect_to" value="<?php if(isset($_GET['r'])) echo $_GET['r']; ?>" />
      <input type="hidden" name="ludou_token" value="<?php echo $token; ?>" />
      <button class="button button-primary button-large" type="submit">登录</button>
    </p>
</form>
<?php } else {
echo '<p class="ludou-error">您已登录！（<a href="'.wp_logout_url().'" title="登出">登出？</a>）</p>';
} ?>