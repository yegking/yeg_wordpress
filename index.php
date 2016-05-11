<?php get_header();?>
<!-- body -->

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory')//获取路径?>/tougao.css" />

<script type="text/javascript">



//显示灰色 jQuery 遮罩层 
function showBg(){ 
var bh = $("body").height(); 
var bw = $("body").width(); 
//里面的内容
$(function(){
$('#t').load('http://localhost/myblog/wordpress/index.php/tougao2/');
});



$("#fullbg").css({ 
height:bh, 
width:bw, 
display:"block" 
}); 
$("#dialog").show(); 
} 
//关闭灰色 jQuery 遮罩 
function closeBg() { 
$("#fullbg,#dialog").hide(); 
} 

			$(document).ready(function() {
				$("div.img-item").mouseover(function() {
					$(this).children(".title-item").show();
					$(this).children(".info-item").show();
				}).mouseout(function() {
					$(this).children(".title-item").hide();
					$(this).children(".info-item").hide();
				});
				$(".tags a").corner('10px');
				$(".brands a").corner('12px');
			});
		

	
</script>

<div id="content">
<div id="m_left">
<!--<input type="text" value=" <?php wp_dropdown_categories('hide_empty=0&id=tougaocategorg&show_count=1&hierarchical=1');?>">-->
<!--这块php主要负责显示顶部图片-->
   <?php if (get_option('strive_slidebar') == 'Display') { //侧边栏?>
  <div class="topad"> <a href=" <?php echo stripslashes(get_option('strive_adurl')); //stripslashes删除由 函数添加的反斜杠，strive_adurl为需要在首页顶部显示的广告链接地址?>" target="_blank"> <img src="<?php echo stripslashes(get_option('strive_adimg')); //首页顶部显示的广告图片地址?>" width="720px"/></a> </div>
  <?php } else {} ?>
  
   
  <?php if(have_posts()) : ;while(have_posts()) : the_post();//判断是否有日志，又则全部显示?>
 <div class="pic" style="height: 232px" align="left"><!--中间图片的对齐方式等-->
	<!--绝对定位-->
    <div class="img-item" style="width: 355px; height: 232px"> <a href="<?php the_permalink();// 显示一篇日志或页面的永久链接/URL地址?>" title="<?php the_title_attribute();//返回当前文章标题?>" target="_blank"> <?php echo post_thumbnail_img(355,232)//自带缩略图功能?> </a>
      <div class="title-item hide" style="width: 350px; display: none;"><?php echo the_title();?></div><!--鼠标移上去有效果-->
    </div>
  </div>
  <?php endwhile; endif;?>
  <div class="pagenav">﻿
    <div class="pagination">
      <?php pagination(5);?>
  </div>





  </div>

</div>


<div id="m_right"> 
  <!--分类-->
  <div id="cate_float" style="width:210px;">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('侧边栏') ) :; endif;//dynamic_sidebar()这个函数是用来检测，当前的小工具区有没有被设定?>

   
      <div class="clear"></div>
    </div>
	

  </div>
  
  
  <!--标签 end-->
  
</div>


<!--浮现投稿框-->
<div id="fullbg"></div> 
<div id="dialog"> 
<p class="close"><a href="#" onclick="closeBg();">关闭</a></p> 
<div id="t"><form></form></div> 
</div> 





 
<?php get_footer()?>
