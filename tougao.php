<?php
/**
 * Template Name: tougao
 * 作者：露兜
 * 博客：http://www.ludou.org/
 * 
 * 更新记录
 *  2010年09月09日 ：
 *  首个版本发布
 *  
 *  2011年03月17日 ：
 *  修正时间戳函数，使用wp函数current_time('timestamp')替代time()
 *  
 *  2011年04月12日 ：
 *  修改了wp_die函数调用，使用合适的页面title
 *  
 *  2013年01月30日 ：
 *  错误提示，增加点此返回链接
 *  
 *  2013年07月24日 ：
 *  去除了post type的限制；已登录用户投稿不用填写昵称、email和博客地址
 *  
 *  2015年03月08日 ：
 *  使用date_i18n('U')代替current_time('timestamp')
 */


if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
    global $wpdb;
	global $jiance;
	$jiance=0;
	
   // $current_url = 'http://localhost/myblog/wordpress/index.php';   // 注意修改此处的链接地址

    $last_post = $wpdb->get_var("SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1");

    // 博客当前最新文章发布时间与要投稿的文章至少间隔120秒。
    // 可自行修改时间间隔，修改下面代码中的120即可
    // 相比Cookie来验证两次投稿的时间差，读数据库的方式更加安全
    if ( (date_i18n('U') - strtotime($last_post)) < 1) {
       echo "您投稿也太勤快了吧，先歇会儿！";
	   $jiance=1;
	   return;
    }
        
    // 表单变量初始化
    $name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
    $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
    $tel=isset( $_POST['tougao_tel'] ) ? trim(htmlspecialchars($_POST['tougao_tel'], ENT_QUOTES)) : '';
  
	$category =  isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
	 $title =   get_cat_name($category);
    $content =  isset( $_POST['tougao_content'] ) ? trim(htmlspecialchars($_POST['tougao_content'], ENT_QUOTES)) : '';
    
    // 表单项数据验证
    if ( empty($name) || mb_strlen($name) > 20 ) {
        echo "昵称必须填写，且长度不得超过20字。";
		$jiance=1;
		return;
    }
    
    if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        echo "Email必须填写，且长度不得超过60字，必须符合Email格式。";
		$jiance=1;
		return;
    }

	 if ( empty( $tel) || strlen( $tel) !=11 || !preg_match('/^1(3[0-9]|4[57]|5[012356789]|8[0-9]|7[0678])\d{8}$/',$tel)) {
        echo "请正确填写电话".$tel;
		$jiance=1;
		return;
    }
    
   
    
    if ( empty($content) || mb_strlen($content) > 500 || mb_strlen($content) < 5) {
       echo "内容必须填写，且长度不得超过500字，不得少于5字。";
	   $jiance=1;
	   return;
    }
	switch ($title){

		case "打排球" :$picture=175;
		break;
		case "旅游" :$picture=139;
		break;
		case "踢足球" :$picture=125;
		break;
		case "打篮球" :$picture=77;
		break;
		case "打羽毛球" :$picture=37;
		break;
	}
    if(!$jiance){
    $post_content = '发起人昵称: '.$name.'<br />Email: '.$email.'<br />电话:'.$tel.'<br />内容:<br />'.$content;
  

    $tougao = array(
        'post_title' => $title, 
        'post_content' => $post_content,
		 'post_status' => 'publish',
        'post_category' => array($category)
    );

//echo  get_category($category)->slug;
//echo get_permalink();
//echo get_category_link($category);

//$medium_image_url = wp_get_attachment_image_src( 139, ' large');
//echo $medium_image_url[0];



    // 将文章插入数据库
	
    $status = wp_insert_post($tougao);
	if(get_category($category)->slug)//检索数据库的类别行对象传递给$category参数后，参数可缓存类别数据。
set_post_thumbnail($status,$picture);
    if ($status != 0) { 
        // 投稿成功给博主发送邮件
        // somebody#example.com替换博主邮箱
        // My subject替换为邮件标题，content替换为邮件内容
        wp_mail("www.yegking@163.com","My subject","content");
		
        echo "投稿成功！感谢投稿！";
    }
    else {
       echo "投稿失败！";
    }
	}
}



?>



