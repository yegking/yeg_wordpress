<?php

$themename = "Qingart";
$shortname = "strive";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/css/style/';
$alt_stylesheets = array();
$alt_stylesheets[] = '';

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}
$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array (
array(  'name'=>$themename.' Options',
'type'=>'title'),

array( 'name'=>'常规设置',
'type'=>'section'),
array( 'type'=>'open'),

array(  'name'=>'logo图片地址',
'desc'=>'输入您的logo图片地址',
'id'=>$shortname.'_mylogo',
'type'=>'text',
'std'=>'/wp-content/themes/Qingart/images/logo.gif'),

array(  'name'=>'favicon图标地址',
'desc'=>'输入您的favicon图标地址，将在浏览器地址栏显示',
'id'=>$shortname.'_favicon',
'type'=>'text',
'std'=>'/wp-content/themes/Qingart/images/favicon.ico'),

array(  'name'=>'是否开启timthumb缩略图插件',
'desc'=>'默认开启，将会在主题内cache文件夹生成缩略图缓存，如果您的站点使用七牛等外链图床，或者需要使用动态gif作为缩略图，建议关闭此插件',
'id'=>$shortname.'_timth',
'type'=>'select',
'std'=>'Display',
'options'=>array('Display','Hide')),

array(  'type'=>'close'),
array( 'name'=>'首页布局设置',
'type'=>'section'),
array( 'type'=>'open'),



array(  'name'=>'是否显示首页顶部广告',
'desc'=>'默认不显示，开启后，首页导航栏下方显示广告图片',
'id'=>$shortname.'_slidebar',
'type'=>'select',
'std'=>'Display',
'options'=>array('Hide','Display')),

array(  'name'=>'输入需要在首页顶部显示的广告图片地址',
'desc'=>'图片大小　720 x 150',
'id'=>$shortname.'_adimg',
'type'=>'text',
'std'=>''),


array(  'name'=>'输入需要在首页顶部显示的广告链接地址',
'desc'=>'输入url地址链接',
'id'=>$shortname.'_adurl',
'type'=>'text',
'std'=>''),



array(  'type'=>'close'),

array(  'name'=>'网站SEO设置',
'type'=>'section'),
array(  'type'=>'open'),

array(	'name'=>'描述（Description）',
'desc'=>'',
'id'=>$shortname.'_description',
'type'=>'textarea',
'std'=>'输入你的网站描述，一般不超过200个字符'),

array(	'name'=>'关键词（KeyWords）',
'desc'=>'',
'id'=>$shortname.'_keywords',
'type'=>'textarea',
'std'=>'输入你的网站关键字，一般不超过100个字符'),



array(  'type'=>'close'),
array(  'name'=>'网站底部信息设置',
'type'=>'section'),
array(  'type'=>'open'),


array(  'name'=>'输入你的网站统计代码',
'desc'=>'',
'id'=>$shortname.'_tjcode',
'type'=>'textarea',
'std'=>''),


array(  'name'=>'输入您的备案号',
'desc'=>'',
'id'=>$shortname.'_beianhao',
'type'=>'textarea',
'std'=>'京ICP备10088888号'),

array(  'type'=>'close'),

			
);
function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
}
$file_dir=get_bloginfo('template_directory');
add_menu_page($themename." Options", "Qingart设置", 'edit_theme_options',basename(__FILE__), 'mytheme_admin',$file_dir."/includes/options/loo.png",61);

}
function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_style("functions", $file_dir."/includes/options/css/layout.css", false, "1.0");
wp_enqueue_style("functions", $file_dir."/includes/options/css/colorpicker.css", false, "1.0");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
wp_enqueue_script("rm_script", $file_dir."/includes/options/colorpicker.js", false, "1.0");
}
function mytheme_admin() {
global $themename, $shortname, $options;
$i=0;
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
?>
<script type="text/ecmascript">
        $(function () {
            $('#color').ColorPicker({
                onChange: function (hsb, hex, rgb) {
                    $('#color').val("#" + hex);//设置文本框的值为选定的RGB颜色
                    //$('#color').css('backgroundColor', '#' + hex);//设置文本框的背景颜色为选定的RGB颜色
                }
 
            });
        });
    </script>
<script type="text/javascript">
var _version = '<?php $theme_data = get_theme_data(dirname(__FILE__) . '/../style.css');echo $theme_data['Version'];?>';
jQuery(document).ready(function(){
	jQuery("span.version_number").text(weisaytheme_latest_version);
	jQuery("a.downloand_add").attr("href",downloand_add);
	jQuery("a.author_add").attr("href",author_add);
	if(_version < weisaytheme_latest_version ){
		jQuery(".version_tips").fadeIn(1000);
	}
	else {
		jQuery(".version_tips").hide();
	};
	jQuery(".close_version_tips").click(function(){
		jQuery(this).parent().fadeOut(1000);
	});
	jQuery(".fl_cbradio_op:checked").each(function() {
		jQuery(this).parent().parent().children().eq(3).show();
	});
	jQuery(".fl_cbradio_cl:checked").each(function() {
		jQuery(this).parent().parent().children().eq(3).hide();
	});
	jQuery(".fl_cbradio_cl").click(function(){
		jQuery(this).parent().parent().children().eq(3).slideUp();
	});
	jQuery(".fl_cbradio_op").click(function(){
		jQuery(this).parent().parent().children().eq(3).slideDown();
	});
   jQuery(".theme_options_content > div:not(:first)").hide();
   jQuery(".theme_options_tab li").each(function(index){
       jQuery(this).click(
	   	  function(){
			  jQuery(".theme_options_tab li.current").removeClass("current");
			  jQuery(this).addClass("current");
			  jQuery(".theme_options_content > div:visible").hide();
			  jQuery(".theme_options_content > div:eq(" + index + ")").show();
	  })
   })
})
</script>

<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> 主题设置</h2>
<div style=" margin-bottom:20px; text-align:right;"><a href="http://wpa.qq.com/msgrd?v=3&uin=83842730&site=qq&menu=yes" target="_blank">主题帮助</a> / <a href="http://www.wazhuti.com" target="_blank">更多主题</a></div>
<div class="clear"></div>
<div class="rm_opts">
<div class="rm_opts">
<form method="post"> 
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?>
<?php break;
case "close":
?>
</div>
</div>
<br />
<?php break;
case "title":
?>
<?php break;
case 'text':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'textarea':
?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'select':
?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" >
<?php foreach ($value['options'] as $option) { ?>
		<option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
		<?php
		if ((empty($option) || $option == '' ) && isset($value['default_option_value'])) {
			echo $value['default_option_value'];
		} else {
			echo $option; 
		}?>
		
		</option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
case "checkbox":
?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":
$i++;
?>
<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="保存设置" />
</span><div class="clearfix"></div></div>
<div class="rm_options">
<?php break;}}?>
<input type="hidden" name="action" value="save" />
</form>
<div class="theme-info">
  	<h3>主题声明</h3>
    <blockquote>
    	<p>感谢您使Wazhuti.com提供的Qing主题。为了保护您的合法权益，请购买正版主题。正版主题仅需36元，支持正版，wazhuti.com才有更新的动力，主题才能更完善，功能才能更强大！</p>
        <p>主题使用时遇到问题，或者发现bug，请咨询作者<a href="http://wpa.qq.com/msgrd?v=3&uin=83842730&site=qq&menu=yes" target="_blank">wazhuti</a>在线提问！</p>
    </blockquote>
  </div>



<form method="post">
<p class="submit">
<input name="reset" type="submit" value="恢复默认" /> <font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
<input type="hidden" name="action" value="reset" />
</p>
</form>
 </div> 
 <div class="kg"></div>
 </div>
<?php
}
?>
<?php
function mytheme_wp_head() { 
	$stylesheet = get_option('strive_alt_stylesheet');
	if($stylesheet != ''){?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style/<?php echo $stylesheet; ?>" />
<?php }
} 
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>