<?php
session_start();
$obj = new stdClass();

if(isset($_POST['captcha_id'])&&isset($_POST['captcha_solution'])&&isset($_SESSION["code"])&&isset($_SESSION['token'])){
//接收apply发来的验证
$captcha_id=$_POST['captcha_id'];//TOKEN
$captcha_solution=$_POST['captcha_solution'];//弹出框用户输入的值

//验证码本身
$code=$_SESSION["code"];
unset($_SESSION["code"]);

//token本身
$token=$_SESSION['token'];
unset($_SESSION["token"]);



			if(($captcha_id==$token)&&(strcasecmp($code,$captcha_solution)==0)){
				/*
				$MySQLConnectFile = './email/send_emails_ex.php';
				   require_once($MySQLConnectFile);
			
			//产生用户邮箱验证

			
							
							//$em = rand(10000,99999);
							$em=66666;
							$_SESSION["em"]=$em;
							if(isset($_SESSION["email"]))
							$_SESSION["email1"]=$_SESSION["email"];//is_register 
							unset($_SESSION["email"]);
							
						if((send_mail($_SESSION["email1"],'Email!!!验证码',"邮箱验证码:".$em.'<br/>请在20分钟内完成注册'))==""){
							*/
							$obj->r =0;
						/*}else{
							$obj->r =1;
						}*/
							

						
			}else{
				$obj->r = 1;
				$obj->reason="captcha_required";
			}
			}
		
else{
	$obj->r = 1;
	$obj->code=403;
}

echo json_encode($obj);

?>