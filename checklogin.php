 <?php
/**
 * Template Name: 是否登录
 * 
 * 
 */

$obj = new stdClass();
 
 
 if (!is_user_logged_in()) {
	 $obj->ok=0;
  } else if (current_user_can( 'edit_posts' ) && !current_user_can( 'publish_posts' )) {
	  $obj->ok=1;
	}else if (current_user_can('level_10')) {
		$obj->ok=1;
	}
		else{
		 $obj->ok=2;
	}
echo json_encode($obj);

?>