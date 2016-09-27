<?php get_header();?>
<!--侧边栏据说-->
<div id="content">
<div id="m_left">
  <!--<input type=text value="<?php the_permalink();?>">-->
  <?php if(have_posts()) : ;while(have_posts()) : the_post();?>
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
</div>
</div>
<div class="clear"></div>
<?php get_footer();?>