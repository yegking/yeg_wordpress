<?php get_header();?>
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<div id="m_left">
		<?php the_content('Read more...');?>
	</div>
	<div id="m_right">
		</div>
	<div class="clear"></div>
</div>
</div><?php endwhile;else: ;endif;?>

<div id="backtotop" style="display:none;visibility: visible; position: fixed; bottom: 110px;"><div id="totop-box" class="top_curr"></div></div>
<?php get_footer();?>