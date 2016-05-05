<div class="clear"></div>
</div>
<script type="text/javascript">
//绑定
if($('#blm-ad-box').length > 0){
//$("#blm-ad-box").smartFloat(550);
}else{
$("#cate_float").smartFloat(550);
}
</script>
</div>
<div id="backtotop" style="display:none;visibility: visible; position: fixed; bottom: 110px;">
  <div id="totop-box" class="top_curr"></div>
</div>
<div id="footer" align="right">
  <div id="contact"> <?php if(function_exists('wp_nav_menu')) {wp_nav_menu(array('theme_location'=>'footnav','menu_id'=>'footnav','container'=>'ul'));}?></div>
  <div id="copyright">Copyright <?php echo comicpress_copyright();?> <a href="<?php bloginfo('siteurl');?>/"><strong>
    <?php bloginfo('name');?>
    </strong></a> Powered by <a href="http://www.wordpress.org/" rel="external">WordPress</a>
    
    
    <br />
    <a href="http://www.miitbeian.gov.cn/" rel="external"><?php echo stripslashes(get_option('strive_beianhao')); //备案号?></a>
    <?php { echo '.'; } ?>
    <?php echo stripslashes(get_option('strive_tjcode')); ?>
    <?php { echo ' '; } ?>
  </p>
  
    
    </div>
  <div class="clear"></div>
</div>
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
            pid: "mm_31052382_4308844_14568843",/*推广单元ID，用于区分不同的推广渠道*/
            appkey: " 21171147",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/
            unid: ""/*自定义统计字段*/
        };
        win.alimamatk_onload = win.alimamatk_onload || [];
        win.alimamatk_onload.push(o);
    })(window,document);
</script>
<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21171147"></script>--> 

<!--以上几行是google的统计分析服务的专用代码。你在谷歌主页可以找到统计服务，在那儿申请一个ID(就是这里的'UA-1245097-16')，然后他会给你这段代码，把这段代码放到你的页面中，就可以自动实现客户端信息的统计，比如分析指定时间段内的访问量、IV、IP量，有多少人、什么样的人、什么样的电脑访问过你的站点，还有网站的转化率等。-->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17811032-4']);
  _gaq.push(['_setDomainName', '.banlimi.com']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script> 
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F43ea25245b845b2abac930f051830092' type='text/javascript'%3E%3C/script%3E"));
</script>
</body></html>