<html>
<head>
  <title>itcast.cn的JQuery实例1：浮动窗口</title>
  <!--链接外部的js文件-->
  <script type="text/javascript" src="js/jquery.min.js"></script>  
  <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
  
</head>
<body>
    <a onclick="showwin()" href="#">显示浮动窗口</a>
    <!--如何表示页面中的一个弹出窗口?可以使用div来表示-->
    <!--目前怎么看都不是一个窗口，因此需要用css来改变一下这个div的样子-->
    <!--出现标题栏和内容区域-->
    <div id="win">
        <div id="title">我是标题栏啊！！<span id="close" onclick="hide()">X</span></div>
        <div id="content">我是一个窗口哦！！</div>
    </div>
  
</body>
</html>
<style>
*id选择器*/
#win {
    /*希望窗口有边框*/
    border: 1px red solid;
    /*希望窗口宽度和高度固定，不要太大*/
    width: 300px;
    height: 200px;
    /*希望控制窗口的位置*/
    position: absolute;  /*绝对定位*/
    top: 100px;
    left: 350px;
    /*希望窗口开始时不可见*/
    display: none;
}
 
/*控制标题栏的样式*/
#title {
    /*控制标题栏的背景色*/
    background-color: blue;
    /*控制标题栏中文字的颜色*/
    color: yellow;
    /*控制标题栏的左内边距*/
    padding-left:3px;
}
 
/*控制内容区域的样式*/
#content {
    padding-left: 3px;
    padding-top: 5px
}
/*控制关闭按钮的位置*/
#close {
    /*使关闭按钮向右侧移动*/
    margin-left: 158px;
    /*让鼠标进入时可以显示小手，告知用户可以点击操作*/
    cursor: pointer;
}
</style>
<script type="text/javascript">

//显示浮动窗口的方法
function showwin() {
    //1.找到窗口对应的div节点
    var winNode = $("#win");
    //2.让div对应的窗口显示出来
    //方法1,修改节点的css值，让窗口显示出来
    //winNode.css("display","block");
    //方法2，利用Jqeury的show方法
    //winNode.show("slow");
    //方法3，利用JQuery的fadeIn方法
    winNode.fadeIn("slow");
}
 
//隐藏窗口的方法
function hide() {
    //1.找到窗口对应的节点
    var winNode = $("#win");
    //2.将窗口隐藏起来
    //方法1，修改css
    //winNode.css("display","none");
    //方法2，利用hide方法
    //winNode.hide("slow");
    //方法3，利用fadeOut方法
    winNode.fadeOut("slow");
 
 
}
</script>
