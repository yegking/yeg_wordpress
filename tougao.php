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
//这里两句换很重要，第一句话告诉浏览器返回的数据是xml格式

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 获取表单字段并删除空白

		$name = trim($_POST["tougao_authorname"]);
		 $message= trim($_POST["tougao_content"]);
		
    $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
	
		// 检查要发送邮件的数据
		if ($name == "" || $email == "" || $message == "") {
			// 设置一个400（错误请求）响应代码并退出
			http_response_code(400);
			echo "糟糕！您提交数据时出现了一个问题。请填完表格，然后再试一次。";
			exit;
		}
		 if ( empty($name) || mb_strlen($name) > 20 ) {
      echo "('昵称必须填写，且长度不得超过20字')";
	  exit;
    }
		
		 
   
}*/











if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
    global $wpdb;
	
   // $current_url = 'http://localhost/myblog/wordpress/index.php';   // 注意修改此处的链接地址

    $last_post = $wpdb->get_var("SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1");

    // 博客当前最新文章发布时间与要投稿的文章至少间隔120秒。
    // 可自行修改时间间隔，修改下面代码中的120即可
    // 相比Cookie来验证两次投稿的时间差，读数据库的方式更加安全
    if ( (date_i18n('U') - strtotime($last_post)) < 120 ) {
       echo "您投稿也太勤快了吧，先歇会儿！";
    }
        
    // 表单变量初始化
    $name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
    $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
    
    $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
  
    $content =  isset( $_POST['tougao_content'] ) ? trim(htmlspecialchars($_POST['tougao_content'], ENT_QUOTES)) : '';
    
    // 表单项数据验证
    if ( empty($name) || mb_strlen($name) > 20 ) {
        echo "昵称必须填写，且长度不得超过20字。";
    }
    
    if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        echo "Email必须填写，且长度不得超过60字，必须符合Email格式。";
    }
    
    if ( empty($title) || mb_strlen($title) > 100 ) {
        echo "标题必须填写，且长度不得超过100字。";
    }
    
    if ( empty($content) || mb_strlen($content) > 3000 || mb_strlen($content) < 1) {
       echo "内容必须填写，且长度不得超过3000字，不得少于100字。";
    }
    
    $post_content = '昵称: '.$name.'<br />Email: '.$email.'<br />内容:<br />'.$content;
    
    $tougao = array(
        'post_title' => $title, 
        'post_content' => $post_content,
        'post_category' => array($category)
    );


    // 将文章插入数据库
    $status = wp_insert_post($tougao);
  
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

?>



