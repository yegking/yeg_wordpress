<?php get_header();?>
<!-- body -->
<script type="text/javascript">
			$(document).ready(function() {
				//页面加载完成后开始运行其中的语句!
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
  
  <?php if(have_posts()) : ;while(have_posts()) : the_post();?><!--通常在WordPress的循环中使用，用以获取所有文章,对应endwhile-->
  <div class="pic" style="height: 232px" align="left">
    <div class="img-item" style="width: 355px; height: 232px"> <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" target="_blank"> <?php echo post_thumbnail_img(355,232)?> </a>
      <div class="title-item hide" style="width: 350px; display: none;"><?php echo the_title();?></div>
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
  
   <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('侧边栏') ) :; endif;?>
   
      <div class="clear"></div>
    </div>
  </div>
  
  <!--标签 end-->
 
</div>
<?php get_footer()?>
