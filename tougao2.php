<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<body>
<?php
/**
 * Template Name: tougao2

 *  
 */


?>
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/tougao.js"></script>

		
<div id="form-messages"></div>
<form id="tougao_form" class="ludou-tougao" action="<?php echo get_option('home'); ?>/index.php/active/" method="POST">
    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_authorname">昵称:*</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_login; ?>" id="tougao_authorname" name="tougao_authorname" />
    </div>

    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_authoremail">E-Mail:*</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_email; ?>" id="tougao_authoremail" name="tougao_authoremail" />
    </div>
	<div style="text-align: left; padding-top: 10px;">
        <label for="tougao_tel">电话:*</label>
        <input type="text" size="40" placeholder="以便对方联系！" id="tougao_tel" name="tougao_tel" />
    </div>

	 <div style="text-align: left; padding-top: 10px;">
        <label for="tougaocategorg">分类:*</label>
        <?php wp_dropdown_categories('hide_empty=0&id=tougaocategorg&exclude=1,2,5&show_count=0&hierarchical=1'); ?>
    </div>


   
                    
    <div style="text-align: left; padding-top: 10px;">
        <label style="vertical-align:top" for="tougao_content">文章内容:*</label>
        <textarea rows="10" cols="35" placeholder="可以填写活动的大体方位"  id="tougao_content" name="tougao_content"></textarea>
    </div>
                    
    <br clear="all">
    <div style="text-align: center; padding-top: 10px;">
        <input type="hidden" value="send" id="tougao_form" name="tougao_form" />
        <input type="submit" id="btn1" value="提交" />
	<input type="hidden" id="user_security" name="user_security" value="<?php echo wp_create_nonce( 'user_security_nonce' );?>">
	<input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <input type="reset" value="重填" />
    </div>
</form>
	</div>
	<div id="m_right">
		</div>
	<div class="clear"></div>
</div>
</div>


</body>
</html>