<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php include('includes/seo.php');?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory')//获取路径?>/style.css" />
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/main.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/jquery.corner.js"></script>

<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>


<?php if ( is_singular() ){ //当前显示的是不是一条单独的post所形成的页面?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/images/lightbox/pirobox.css" target="_blank" />
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?> RSS Feed" href="<?php bloginfo('rss2_url');?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name');?> Atom Feed" href="<?php bloginfo('atom_url');?>" />
<link rel="shortcut icon" href="<?php echo stripslashes(get_option('strive_favicon')); ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="images/x-icon"/>
<!--<?php bloginfo(’template_url’); ?> : 模板文件路径-->
<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.gif" type="images/gif"/>


<!--<input type="textbox" value="<?php echo bloginfo('url'); ?>/wp-login.php";>-->
<!--一旦文章发表后，就会自动启动Pingback功能，这功能会发送一个Ping给对方，会以评论的方式呈现-->
<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
<?php my_scripts_method; wp_head()?>
<?php flush()?>
<style>
	#post_container .fixed-hight .thumbnail{height:<?php echo stripslashes(get_option('strive_timthigh')); ?>px; overflow: hidden;}
</style>


<script type="text/javascript">
	$(document).ready(function() {
		$('#menus > li').each(function() {
			$(this).hover(function() {
				$(this).find('ul:eq(0)').show();
			}, function() {
				$(this).find('ul:eq(0)').hide();
			});
		});
	});
</script>
<!--
<script type="text/javascript">
    (function(win,doc){
        var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
        if (!win.alimamatk_show) {
            s.charset = "gbk";
            s.async = true;
            s.src = "http://a.alimama.cn/tkapi.js";
            h.insertBefore(s, h.firstChild);
        };
        var o = {
            pid: "mm_28557007_6508513_22328733",
            appkey: " 21784812",
            unid: ""
        };
        win.alimamatk_onload = win.alimamatk_onload || [];
        win.alimamatk_onload.push(o);
    })(window,document);
</script>
<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21784812"></script>-->

</head>
<body>
<div class="header">
	<div class="top-box">
	<div class="fleft bmsg"><?php bloginfo('description'); //博客描述?></div>
	<?php 
if(0 != $current_user->ID ){}
 
else{
   $link=bloginfo('url'); 
   echo  "<div class=\"fright ma-zhuce\" id=\"ma-zhuce\"><a  href=\"<?php echo bloginfo(\'url\'); ?>/index.php/register\">注册</a></div>";
	echo  '<div class="fright ma-zhuce" id="ma-zhuce"><a  href="'.bloginfo("url").'/index.php/register">注册</a></div>';
}
	
?>
<!--<div class="fright ma-zhuce" id="ma-zhuce"><a  href="<?php echo bloginfo('url'); ?>/index.php/register">注册</a></div>-->
	
	<div class="fright">
	</div>
	</div>
</div>
<div class="wrapper">
<div id="daohang">
	<div class="logo bd-on">
	<a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"><?php if ( is_home() || is_search() || is_category() || is_month() || is_author() || is_archive() ) { ?><?php } ?>
	
	 <img src="<?php bloginfo('template_url'); ?>/images/logo.gif" alt="<?php bloginfo('name');?>" />
                       <!-- <img src="<?php echo stripslashes(get_option('strive_mylogo')); ?>" alt="<?php bloginfo('name');?>" />--></a>	
	</div>
	<div class="nav">
		<ul id="menus" class="menus topdh">
												<?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'nav', 'echo' => false)) )); //string ereg_replace ( string $pattern , string $replacement , string $string )本函数在 string 中扫描与 pattern 匹配的部分，并将其替换为 replacement。wp_nav_menu该语句将会加载用户创建的菜单或者如果导航菜单,theme_location’ => ‘nav’,这句代码调用的是主菜单的意思。echo: 定义是显示该菜单还是仅仅返回数据供PHP程序使用。默认是真，直接显示该菜单。?>

	
			<li class='mleft8 w200 bd-no'>
			<form method="get" action="<?php bloginfo('home');?>">
			<div class="search-box">
				<input type="text" name="s" class="search_input" value="" maxlength="150" placeholder="请输入搜索内容"  />
				<input type="submit" class="search_btn" value="" />
			</div>
			</form>
			</li>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<!-- body -->
<script type="text/javascript">
$(document).ready(function(){
	$("div.img-item").mouseover(function() {
    	$(this).children(".title-item").show();
    	$(this).children(".info-item").show();
  	}).mouseout(function(){ 
    	$(this).children(".title-item").hide();
    	$(this).children(".info-item").hide();
	});
   	$(".tags a").corner('10px');
   	$(".brands a").corner('12px');
});
</script>