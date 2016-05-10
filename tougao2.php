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

<!--
<script>
$(document).ready(function(){
var arr = $('#tougao_form').serializeArray();
var arr2=$.param(arr);
  $("#btn1").click(function(){ 
	  var oajax=$.ajax({
        url:'http://localhost/myblog/wordpress/index.php/active/',
        type:'POST',
		async:ture,
        data:"data"+arr2,
        success:function(result){
            $("#t").empty().append(result);
        },
        error:function(msg){
            alert('Error:'+msg);
        }
    });

	$('#txtHint').html(oajax.responseText).//当于基本语法的innerHTML="";你向ajax后台的程序发送xmlhttp请求的时候, 后台程序接到请求会进行处理,处理结束后,可以返回一串数据给前台,这个就是responseText. 

  })
})
</script>
-->
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
        <label for="tougao_title">文章标题:*</label>
        <input type="text" size="40" value="" id="tougao_title" name="tougao_title" />
    </div>

   
                    
    <div style="text-align: left; padding-top: 10px;">
        <label style="vertical-align:top" for="tougao_content">文章内容:*</label>
        <textarea rows="15" cols="55" id="tougao_content" name="tougao_content"></textarea>
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