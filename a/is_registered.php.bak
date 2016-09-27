 <?php
/**
 * Template Name: 邮箱是否注册
 * 
 * 博客：http://www.ludou.org/
 *  
 *  2013年02月02日 ：
 *  首个版本
 */
 session_start();
$obj = new stdClass();
 $user_email = apply_filters( 'user_registration_email', $_GET['email'] );
					if ( email_exists( $user_email ) ) {
							  $obj->ok=1;
						  }else{
							  $obj->ok=0;
							  $_SESSION["email"]=$_GET['email'];
							  }
echo json_encode($obj);

?>