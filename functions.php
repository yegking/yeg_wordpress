<?php
//移除顶部工具栏
add_filter( 'show_admin_bar', '__return_false' );
//更改后台管理界面字体 devework.com
function Bing_admin_lettering(){
    echo'<style type="text/css">
        * { font-family: "Microsoft YaHei" !important; }
        i, .ab-icon, .mce-close, i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page, .qt-fullscreen, .star-rating .star { font-family: dashicons !important; }
        .mce-ico { font-family: tinymce, Arial !important; }
        .fa { font-family: FontAwesome !important; }
        .genericon { font-family: "Genericons" !important; }
        .appearance_page_scte-theme-editor #wpbody *, .ace_editor * { font-family: Monaco, Menlo, "Ubuntu Mono", Consolas, source-code-pro, monospace !important; }
        .post-type-post #advanced-sortables, .post-type-post #autopaging .description { display: none !important; }
        .form-field input, .form-field textarea { width: inherit; border-width: 0; }
        </style>';
}
add_action('admin_head', 'Bing_admin_lettering');

//文章拓展
include('includes/metabox.php');

//屏蔽小工具
add_action( 'widgets_init', 'my_unregister_widgets' );   
function my_unregister_widgets() {   
    unregister_widget( 'WP_Widget_Archives' );   
    unregister_widget( 'WP_Widget_Calendar' );   
    unregister_widget( 'WP_Widget_Links' );   
    unregister_widget( 'WP_Widget_Meta' );   
    unregister_widget( 'WP_Widget_Pages' );   
    unregister_widget( 'WP_Widget_Recent_Comments' );   
    unregister_widget( 'WP_Widget_Recent_Posts' );   
    unregister_widget( 'WP_Widget_RSS' );   
    unregister_widget( 'WP_Widget_Search' );   
    unregister_widget( 'WP_Nav_Menu_Widget' );   
} 

//函数开始
include('includes/theme_options.php');//后台设置
include('includes/breadcrumbs.php');//面包屑

//侧边栏
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
	'name'=>'侧边栏',
	'description'   => '以下小工具在页面右边显示',
	'before_widget'=>'<div class="widget box row">',
	'after_widget'=>'</div>',
	'before_title'=>'<h3>',
	'after_title'=>'</h3>',
	));
   
}
//定义菜单
    if (function_exists('register_nav_menus')){
        register_nav_menus( array(
            'nav' => __('导航'),
            'footnav' => __('底部菜单'),
        ) );
    }
//特色图片尺寸
add_theme_support('post-thumbnails');
//开启wordpress3.5友情链接管理
add_filter( 'pre_option_link_manager_enabled', '__return_true' ); 
//去除自带js
	wp_deregister_script( 'l10n' );
//翻页样式

if ( !function_exists('pagenavi') ) { 
function pagenavi( ) { 
if ( is_singular() ) return; // 文章与插页不用 
global $wp_query, $paged; 
$max_page = $wp_query->max_num_pages; 
if ( emptyempty( $paged ) ) $paged = 1; 
if ( $paged > 1 ) p_linkp( $paged - 1, '上一页' );/* 如果当前页大于1就显示上一页链接 */ 
if ( $paged == 1 ) p_linkp1( $paged );/* 如果当前页等于1就显示灰色链接 */ 
if ( $paged < $max_page ) p_linkn( $paged + 1,'下一页' );/* 如果当前页不是最后一页显示下一页链接 */ 
if ( $paged == $max_page ) p_linkp0( $paged );/* 如果当前页等于最后一页显示灰色链接 */ 
} 
function p_linkp( $i, $title = '', $linktype = '' ) { 
echo "<div class='pre-page page'><a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a></div> "; 
} 
function p_linkn( $i, $title = '', $linktype = '' ) { 
echo "<div class='next-page page'><a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a></div> "; 
} 
function p_linkp0() { 
echo "<div class='pre-page page nav0'></a></div> "; 
} 
function p_linkp1() { 
echo "<div class='pre-page page nav1'></a></div> "; 
} 
}
//修改文本编辑器
add_filter('mce_buttons_3','my_buttons');
function my_buttons($buttons){
	$mces=array(
		'cut',
		'copy',
		'paste',
		'hr',
		'fontselect',
		'fontsizeselect',
		'sub',
		'sup',
		'backcolor',
		'visualaid',
		'anchor',
		'newdocument',
	);
	foreach($mces as $mce){
		$buttons[]=$mce;
	}
	return $buttons;
}
//热评文章列表
function simple_get_most_viewed($posts_num=10,$days=90){
global $wpdb;
$sql = "SELECT ID , post_title , comment_count
            FROM $wpdb->posts
           WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
		   AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit')
           ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
$posts = $wpdb->get_results($sql);
$output = '';
foreach ($posts as $post){
$output .= "\n<li><a href= \"".get_permalink($post->ID)."\" target=\"_blank\" rel=\"bookmark\" title=\"".$post->post_title.' ('.$post->comment_count."条评论)\" >".$post->post_title.'</a></li>';
}
echo $output;
}
//分页导航
function pagination($range = 6){
	global $paged, $wp_query;
	echo "<div class='pagination'>";
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'>首页</a>";}
	if($paged>1) echo '<a href="' . get_pagenum_link($paged-1) .'" class="prev">上一页</a>';
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	if($paged<$max_page) echo '<a href="' . get_pagenum_link($paged+1) .'" class="next">下一页</a>';
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'>尾页</a>";
	}
	}
	echo "</div>";
}

//自动生成版权时间
function comicpress_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
    SELECT
    YEAR(min(post_date_gmt)) AS firstdate,
    YEAR(max(post_date_gmt)) AS lastdate
    FROM
    $wpdb->posts
    WHERE
    post_status = 'publish'
    ");
$output = '';
if($copyright_dates) {
$copyright = '&copy; '.$copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-'.$copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}
//暗箱效果自动添加标签属性
function lightbox_auto($content) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)>/i";
	$replacement = '<a$1href=$2$3$4$5$6 data-title="'.$post->post_title.'" data-lightbox="'.$post->ID.'">';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}
add_filter('the_content', 'lightbox_auto',99);
//自动用文章标题为图片添加alt
add_filter( 'the_content', 'image_alt' );
function image_alt($c) {
 global $post;
 $title = $post->post_title;
 $s = array('/src="(.+?.(jpg|bmp|png|jepg|gif))"/i' => 'src="$1" alt="'.$title.'"');
 foreach($s as $p => $r){
  $c = preg_replace($p,$r,$c);
    }
    return $c;
}
/*分类描述*/
function loo_deletehtml($str) {  
    return trim(strip_tags($str)); 
} 
add_filter('category_description', 'loo_deletehtml');
/*显示文章浏览次数*/
function getPostViews($postID){
$count = get_post_meta($postID,'views', true);
if($count==''){
delete_post_meta($postID,'views');
add_post_meta($postID,'views', '0');
return "0";
}
return $count.'';
}
function setPostViews($postID) {
$count = get_post_meta($postID,'views', true);
if($count==''){
$count = 0;
delete_post_meta($postID,'views');
add_post_meta($postID,'views', '0');
}else{
$count++;
update_post_meta($postID,'views', $count);
}
}
//图片默认连接到媒体文件(原始链接)
update_option('image_default_link_type', 'file');
//去除头部冗余代码
remove_action( 'wp_head',   'feed_links_extra', 3 ); 
remove_action( 'wp_head',   'rsd_link' ); 
remove_action( 'wp_head',   'wlwmanifest_link' ); 
remove_action( 'wp_head',   'index_rel_link' ); 
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head',   'wp_generator' ); 

//修改评论表情调用路径
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src,$img,$siteurl){
return get_bloginfo('template_directory').'/images/smilies/'.$img;
}
function wp_smilies(){
  $a = array( 'mrgreen','razz','sad','smile','oops','grin','eek','???','cool','lol','mad','twisted','roll','wink','idea','arrow','neutral','cry','?','evil','shock','!' );
  $b = array( 'mrgreen','razz','sad','smile','redface','biggrin','surprised','confused','cool','lol','mad','twisted','rolleyes','wink','idea','arrow','neutral','cry','question','evil','eek','exclaim' );
  for( $i=0;$i<22;$i++ ){
    echo '<a title="'.$a[$i].'" href="javascript:grin('."'".$a[$i]."'".')"><img src="'.get_bloginfo('template_directory').'/images/smilies/icon_'.$b[$i].'.gif" /></a>';
  }
}


//输出缩略图地址
function post_thumbnail_img($width,$height) {
	global $post;
	$title = $post->post_title;
	if (get_option('strive_timth')=='Display'){
		if ( has_post_thumbnail() ) {
			$timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID) , 'full');
			$post_timthumb = '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=' . $timthumb_src[0] . '&amp;h=' . $height . '&amp;w=' . $width . '&amp;zc=1" width="'.$width.'" height="'.$height.'" alt="' . $title . '" />';
			echo $post_timthumb;
		} else {
			$content = $post->post_content;
			preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
			$n = count($strResult[1]);
			if($n > 0){
			echo '<img src="' . get_bloginfo("template_url").'/timthumb.php?src=' . $strResult[1][0] . '&amp;h=' . $height . '&amp;w=' . $width . '&amp;zc=1" width="'.$width.'" height="'.$height.'" alt="'.$title.'" />';
		}else {
			echo '<img src="' . get_bloginfo("template_url").'/images/noimage.gif" width="'.$width.'" height="'.$height.'" alt="暂无图片">';
			}
		}
	}else{
		if ( has_post_thumbnail() ) {
			the_post_thumbnail(array($width,$height));
		} else {
			$content = $post->post_content;
			preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
			$n = count($strResult[1]);
			if($n > 0){
				echo '<img src="'.$strResult[1][0].'" width="'. $width .'" height="'.$height.'" alt="'.$title.'"/>';
			}else {
				echo '<img src="' . get_bloginfo("template_url").'/images/noimage.gif" width="'.$width.'" height="'.$height.'" alt="暂无图片">';
				}
			}
	}
}
//列表图片
function post_thumbnail_list($width=300) {
	global $post;
	$title = $post->post_title;
	if (get_option('strive_timth')=='Display'){
		if ( has_post_thumbnail() ) {
			$timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID) , 'full');
			$post_timthumb = '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=' . $timthumb_src[0] . '&amp;w=' . $width . '&amp;zc=1;a=t" alt="' . $title . '" />';
			echo $post_timthumb;
		} else {
			$content = $post->post_content;
			preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
			$n = count($strResult[1]);
			if($n > 0){
				echo '<img src="' . get_bloginfo("template_url").'/timthumb.php?src=' . $strResult[1][0] . '&amp;w=' . $width . '&amp;zc=1" alt="'.$title.'" />';
			}
		}
	}else{
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		} else {
			$content = $post->post_content;
			preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
			$n = count($strResult[1]);
			if($n > 0){
				echo '<img src="'.$strResult[1][0].'" width="'. $width .'" height="auto" alt="'.$title.'"/>';
				}
			}
	}
}

//修改登录页logo和链接
if ( !function_exists( 'loostrive_login_logo' ) ) {
	function loostrive_login_logo() {
	    echo '<style type="text/css">
	        h1 a { background-image:url('.stripslashes(get_option(strive_mylogo)).') !important; background-size: auto auto !important;width:auto !important; }
	    </style>';
	}
}
add_action('login_head', 'loostrive_login_logo');

if ( !function_exists( 'loostrive_wp_login_url' ) ) {
	function loostrive_wp_login_url() {
		return home_url();
	}
}
add_filter('login_headerurl', 'loostrive_wp_login_url');

if ( !function_exists( 'loostrive_wp_login_title' ) ) {
	function loostrive_wp_login_title() {
		return get_option('blogname');
	}
}
add_filter('login_headertitle', 'loostrive_wp_login_title');
//开启后台自定义背景
add_theme_support('custom-background');
//去除谷歌字体
    if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    }
	// 前台删除Google字体CSS
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
	// 后台删除Google字体CSS
    add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
  endif;
  
// 在 WordPress 编辑器添加“下一页”按钮
add_filter('mce_buttons','add_next_page_button');
function add_next_page_button($mce_buttons) {
	$pos = array_search('wp_more',$mce_buttons,true);
	if ($pos !== false) {
		$tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
		$tmp_buttons[] = 'wp_page';
		$mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
	}
	return $mce_buttons;
}
//取消内容转义
$qmr_work_tags = array(
  'the_title',             // 标题
  'the_content',           // 内容 *
  'the_excerpt',           // 摘要 *
  'single_post_title',     // 单篇文章标题
  'comment_author',        // 评论作者
  'comment_text',          // 评论内容 *
  'link_description',      // 友链描述（已弃用，但还很常用）
  'bloginfo',              // 博客信息
  'wp_title',              // 网站标题
  'term_description',      // 项目描述
  'category_description',  // 分类描述
  'widget_title',          // 小工具标题
  'widget_text'            // 小工具文本
  );
foreach ( $qmr_work_tags as $qmr_work_tag ) {
  remove_filter ($qmr_work_tag, 'wptexturize');
}
//多说官方Gravatar头像调用
function get_avatar_loo( $avatar ) {
  $avatar = preg_replace( "/http%3A%2F%2F\d.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D\d+/","mm",$avatar );
  $avatar = preg_replace( "/http:\/\/(www|\d).gravatar.com/","http://gravatar.duoshuo.com",$avatar );
  return $avatar;
}
add_filter( 'get_avatar', 'get_avatar_loo' );
//内容分页
function custom_wp_link_pages( $args = '' ) {
    $defaults = array(
        'before' => '<div class="pagelist">分页阅读：', 
        'after' => '</div>',
        'text_before' => '',
        'text_after' => '',
        'next_or_number' => 'number', 
        'nextpagelink' =>'下一页',
        'previouspagelink' =>'上一页',
        'pagelink' => '%',
        'echo' => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    $output = '';
    if ( $multipage ) {
        if ( 'number' == $next_or_number ) {
            $output .= $before;
            for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
                $j = str_replace( '%', $i, $pagelink );
                $output .= ' ';
                if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                    $output .= _wp_link_page( $i );
                else
                    $output .= '<span>';

                $output .= $text_before . $j . $text_after;
                if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                    $output .= '</a>';
                else
                    $output .= '</span>';
            }
            $output .= $after;
        } else {
            if ( $more ) {
                $output .= $before;
                $i = $page - 1;
                if ( $i && $more ) {
                    $output .= _wp_link_page( $i );
                    $output .= $text_before . $previouspagelink . $text_after . '</a>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $output .= _wp_link_page( $i );
                    $output .= $text_before . $nextpagelink . $text_after . '</a>';
                }
                $output .= $after;
            }
        }
    }

    if ( $echo )
        echo $output;

    return $output;
}
/**
* Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
	return array_diff( $plugins, array( 'wpemoji' ) );
}
function smilies_reset() {
global $wpsmiliestrans;

// don't bother setting up smilies if they are disabled
if ( !get_option( 'use_smilies' ) )
    return;

    $wpsmiliestrans = array(
    ':mrgreen:' => 'icon_mrgreen.gif',
    ':neutral:' => 'icon_neutral.gif',
    ':twisted:' => 'icon_twisted.gif',
      ':arrow:' => 'icon_arrow.gif',
      ':shock:' => 'icon_eek.gif',
      ':smile:' => 'icon_smile.gif',
        ':???:' => 'icon_confused.gif',
       ':cool:' => 'icon_cool.gif',
       ':evil:' => 'icon_evil.gif',
       ':grin:' => 'icon_biggrin.gif',
       ':idea:' => 'icon_idea.gif',
       ':oops:' => 'icon_redface.gif',
       ':razz:' => 'icon_razz.gif',
       ':roll:' => 'icon_rolleyes.gif',
       ':wink:' => 'icon_wink.gif',
        ':cry:' => 'icon_cry.gif',
        ':eek:' => 'icon_surprised.gif',
        ':lol:' => 'icon_lol.gif',
        ':mad:' => 'icon_mad.gif',
        ':sad:' => 'icon_sad.gif',
          '8-)' => 'icon_cool.gif',
          '8-O' => 'icon_eek.gif',
          ':-(' => 'icon_sad.gif',
          ':-)' => 'icon_smile.gif',
          ':-?' => 'icon_confused.gif',
          ':-D' => 'icon_biggrin.gif',
          ':-P' => 'icon_razz.gif',
          ':-o' => 'icon_surprised.gif',
          ':-x' => 'icon_mad.gif',
          ':-|' => 'icon_neutral.gif',
          ';-)' => 'icon_wink.gif',
    // This one transformation breaks regular text with frequency.
    //     '8)' => 'icon_cool.gif',
           '8O' => 'icon_eek.gif',
           ':(' => 'icon_sad.gif',
           ':)' => 'icon_smile.gif',
           ':?' => 'icon_confused.gif',
           ':D' => 'icon_biggrin.gif',
           ':P' => 'icon_razz.gif',
           ':o' => 'icon_surprised.gif',
           ':x' => 'icon_mad.gif',
           ':|' => 'icon_neutral.gif',
           ';)' => 'icon_wink.gif',
          ':!:' => 'icon_exclaim.gif',
          ':?:' => 'icon_question.gif',
    );
}

//自己加的路由
function add_query_vars($aVars) {
  $aVars[] = "id"; 
  return $aVars;
}
// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');

function add_rewrite_rules($aRules) {
  $aNewRules = array('(index.php/checkcode)' => 'checkcode?id=$matches[1]');
  $aRules = $aNewRules + $aRules;
  return $aRules;
}

// hook add_rewrite_rules function into rewrite_rules_array
add_filter('rewrite_rules_array', 'add_rewrite_rules');



//为注册添加字段
add_action( 'user_register', 'pft_registration_save', 10, 1 );
function pft_registration_save( $user_id ) {
    if ( isset( $_POST['loc'] ) )
        update_user_meta($user_id, 'loc', $_POST['loc']);
}




//在首页中排除某些分类
function exclude_category_home( $query ) {
if ( $query->is_home ) {
$query->set( 'cat', '-10' ); //你要排除的分类ID
}
return $query;
}
add_filter( 'pre_get_posts', 'exclude_category_home' );



//屏蔽后台更新模块

function wp_hide_nag() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','wp_hide_nag');

//屏蔽后台页脚版本信息

function change_footer_admin () {return '';}
add_filter('admin_footer_text', 'change_footer_admin', 9999);
function change_footer_version() {return '';}
add_filter( 'update_footer', 'change_footer_version', 9999);

//屏蔽后台左上角的LOGO
function annointed_admin_bar_remove() {
        global $wp_admin_bar;
        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);



function example_remove_dashboard_widgets() {
    global $wp_meta_boxes;
    // 以下这一行代码将删除 "插件" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
   
  
    // 以下这一行代码将删除 "WordPress 开发日志" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    // 以下这一行代码将删除 "其它 WordPress 新闻" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
   
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );


//屏蔽 WP 后台“显示选项”和“帮助”选项卡

function remove_screen_options(){ return false;}
    add_filter('screen_options_show_screen', 'remove_screen_options');
    add_filter( 'contextual_help', 'wpse50723_remove_help', 999, 3 );
    function wpse50723_remove_help($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}









smilies_reset();
//主题函数结束



?>
