<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<body>
<?php
/**
 * Template Name: tougao2

 *  使用date_i18n('U')代替current_time('timestamp')
 */


?>
<script>
$(document).ready(function(){
  $("#btn1").click(function(){ $.ajax({
        url:'http://localhost/myblog/wordpress/index.php/active/',
        type:'POST',
		async:ture,
        data:'name='+$("#tougao_form").html(),
        success:function(result){
            $("#t").empty().append(result);
        },
        error:function(msg){
            alert('Error:'+msg);
        }
    });
  })
})
</script>

		
		<!-- 关于表单样式，请自行调整-->
<form class="ludou-tougao" method="post" action="">
    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_authorname">昵称:*</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_login; ?>" id="tougao_authorname" name="tougao_authorname" />
    </div>

    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_authoremail">E-Mail:*</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_email; ?>" id="tougao_authoremail" name="tougao_authoremail" />
    </div>
                    
    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_authorblog">您的博客:</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_url; ?>" id="tougao_authorblog" name="tougao_authorblog" />
    </div>

    <div style="text-align: left; padding-top: 10px;">
        <label for="tougao_title">文章标题:*</label>
        <input type="text" size="40" value="" id="tougao_title" name="tougao_title" />
    </div>

    <div style="text-align: left; padding-top: 10px;">
        <label for="tougaocategorg">分类:*</label>
        <?php wp_dropdown_categories('hide_empty=0&id=tougaocategorg&show_count=1&hierarchical=1');?>
    </div>
                    
    <div style="text-align: left; padding-top: 10px;">
        <label style="vertical-align:top" for="tougao_content">文章内容:*</label>
        <textarea rows="15" cols="55" id="tougao_content" name="tougao_content"></textarea>
    </div>
                    
    <br clear="all">
    <div style="text-align: center; padding-top: 10px;">
        <input type="hidden" value="send" id="tougao_form" name="tougao_form" />
        <input type="submit" id="btn1" value="提交" />
        <input type="reset" value="重填" />
    </div>
</form>
	</div>
	<div id="m_right">
		</div>
	<div class="clear"></div>
</div>
</div>

<div id="backtotop" style="display:none;visibility: visible; position: fixed; bottom: 110px;"><div id="totop-box" class="top_curr"></div></div>

</body>
</html>