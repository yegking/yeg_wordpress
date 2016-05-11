<?php get_header();?>

<div id="content">
<div id="m_left"><!--{float:left;width:730px;margin-right:20px;}-->
  <div id="p_left"><!--{float:left;width:650px;margin-right:30px;_margin-right:28px;}-->
  
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
	
    <div id="pbox" align="center"><!--{border:1px solid #efefef;margin-bottom:10px;padding:4px;position:relative;}-->
      <div id="picwrap" style="padding: 0px;"> <?php echo the_post_thumbnail(640,420)?> </div><!--改变页面图片大小-->
      <div class="hide" id="nextprev">
       
          <?php previous_post_link('%link', ' <div class="piccontr" id="picleft"  > </div>', TRUE); ?><!--翻页-->
       
      
        <?php next_post_link(' %link', '  <div class="piccontr" id="picright"  ></div> ', TRUE); ?>
        </div>
    </div>
    <div style="height: 40px;line-height: 40px;">
      <div class="fleft" style="line-height: 20px;padding:9px 0;"> <span style="color:#595959;">标签：</span>
        <?php the_tags('',' ','');?>
        &nbsp;&nbsp; </div>
      <div class="fright" style="line-height: 20px;padding: 9px 0 9px 25px;"> </div>
    </div>
    <div id="pnext">
      <h4>他们也在看</h4>
      <ul>
        <?php
$post_num = 8;
$exclude_id = $post->ID; 
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) {
	$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ','; 
	$args = array(
		'post_status' => 'publish',
		'tag__in' => explode(',', $tags), 
		'post__not_in' => explode(',', $exclude_id), 
		'caller_get_posts' => 1,
		'orderby' => 'comment_date', 
		'posts_per_page' => $post_num
	);
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
        <li style="margin-bottom: 15px;"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"> <?php echo post_thumbnail_img(150,98)?> </a> </li>
        <?php
		$exclude_id .= ',' . $post->ID; $i ++;
	} wp_reset_query();
}
if ( $i < $post_num ) { 
	$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
	$args = array(
		'category__in' => explode(',', $cats), 
		'post__not_in' => explode(',', $exclude_id),
		'caller_get_posts' => 1,
		'orderby' => 'comment_date',
		'posts_per_page' => $post_num - $i
	);
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
        <li style="margin-bottom: 15px;"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"> <?php echo post_thumbnail_img(150,98)?> </a> </li>
        <?php $i++;
	} wp_reset_query();
}
if ( $i  == 0 )  echo '<div class=\"r_title\">没有相关文章!</div>';
?>
      </ul>
      <div class="clear"></div>
    </div>
  </div>
  <script type="text/javascript">
$(document).ready(function(){
	$("#pbox").mouseover(function() {
					//$('#picleft').css({top:100});
			$('#picleft').css({height:420});
						//$('#picright').css({top:100});
			$('#picright').css({height:420});
					$('#nextprev').show();
  	}).mouseout(function(){
  		$('#nextprev').hide();
	});
});
</script> 
</div>
<div id="m_right"> 
  <!--分类-->
  
  <div id="p_right">
    <h1>
      <?php the_title();?>
    </h1>
	 <h1 ><span style="color:#000000;font-size:4px;font-weight:normal">
      <?php the_content();?>
    </h1>
    <div style="line-height: 52px;">
      <div class="pread fleft"><?php setPostViews(get_the_ID());;echo getPostViews(get_the_ID());?></div>
      <!--<div class="plike fleft">0</div>-->
      <div class="pprice fleft">￥<?php echo get_post_meta($post->ID,"jiage_value",true);?></div>
      <div class="clear"></div>
    </div>
    <div style="margin-bottom: 15px;">
      <div class="pfavor fleft">
        <div style="width:130px; height:40px; background:#ff2591; color:#fff; text-align:center; font-size:16px; line-height:40px;border-radius:3px;">
          <?php wp_zan();?>
        </div>
        </div>
      <div class="pilike fright"> <a href="<?php echo get_post_meta($post->ID,"star_value",true);?>" target="_blank" title="购买链接">
        <div style="width:130px; height:40px; background:#67ce4a; color:#fff; text-align:center; font-size:16px; line-height:40px;border-radius:3px;">想购买</div>
        </a> </div>
      <div class="clear"></div>
    </div>
    <div class="pshare">
      <div class="bdsharebuttonbox"> <a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a> <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a> <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a> <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a> <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a> <a href="#" class="bds_huaban" data-cmd="huaban" title="分享到花瓣"></a> <a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a> <a href="#" class="bds_more" data-cmd="more"></a> </div>
      <script>
		window._bd_share_config=
		{"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script> 
    </div>
    <div class="psumm">
      <?php the_content('Read more...');?>
    </div>
    <div id="pic_tj"></div>
    <div class="clear"></div>
  </div>
</div>
<div class="clear"></div>
<?php endwhile;else: ;endif;?>
<?php get_footer();?>
