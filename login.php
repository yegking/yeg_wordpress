<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录校跃</title>
</head>
<style type="text/css">
.wrapper { width:950px;margin:0 auto; }
.item { clear:both;margin:0 0 15px;zoom:1; }
#header { padding-top:30px; }
#content { min-height:400px;*height:400px; }
.main { float:left;width:590px; }

#item-notNULL { padding-left:75px; }
.redsmall{ color:#F00 ;font-size:12px;}

.item-right {text-align:right;width:170px;}
.small{font-size:12px}

.item-qq { padding:5px 0;width:200px;margin:20px 0 0 30px;border-top:1px solid #eee;border-bottom:1px solid #eee; }

.aside { float:right;width:310px;color:#666; }
</style>
<body>
<div class="wrapper">
    <div id="header"><a href="#"><img src="images/xiaoyue.png" width="218" height="115" /></a></div>
    <div id="content">
    <h1> 登录校跃</h1>
    <div class="main">
      <form id="form1" name="form1" method="post" action="" style="padding-left:35px">
        <div  class="item-right">
       <a href="#" class="small">手机验证码登录</a>
       
        </div>
        
        <div class="item"> 
        <label>账号</label>
        <input name="username" type="text" id="username" />
        <label class="redsmall" >账号不能为空</label>
        </div>
        <div class="item">
        <label>密码</label>
        <input name="pwd"  type="password" id="pwd" />
        </div>
    
        <div class="item">
        <p class="remember">
       &nbsp;&nbsp;&nbsp;
         <input type="checkbox" id="remember" name="remember" >
        <label for="remember" class="small">下次自动登录</label>
          | <a href="#" class="small">忘记密码了</a>
       </p>
        </div>
        <div class="item">
        &nbsp;&nbsp;&nbsp;
        <input type="submit" value="登录" name="tj" id="tj" >
        </div>
  
        <div class="item item-qq">
       <label class="small">第三方登录：</label>
 
    </div>
      </form>
    
    </div>
        <div>
          <ul class="aside">
           <li class="small">>&nbsp;还没有校跃帐号？<a href="#">立即注册</a></li>
           <li class="small">>&nbsp;<a href="#">点击下载校跃移动应用</a> </li>
        </ul>
        </div>
    </div>
</div>
</body>
</html>