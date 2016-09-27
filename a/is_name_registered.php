 <?php
/**
 * Template Name: 用户名是否注册
 * 
 * 
 */
 session_start();
$obj = new stdClass();
  $sanitized_user_login = sanitize_user( $_GET['username'] );
 
 if ( ! validate_username( $sanitized_user_login ) ) {
	 $obj->ok=2;
    $sanitized_user_login = '';
  } elseif ( username_exists( $sanitized_user_login ) ) {
	  $obj->ok=1;
	   $sanitized_user_login = '';
	}else{
		 $obj->ok=0;
		   $_SESSION["name"]=$_GET['username'];
	}
echo json_encode($obj);

?>