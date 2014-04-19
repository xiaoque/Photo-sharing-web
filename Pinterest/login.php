<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/logreg.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login - Pinterest</title>
</head>

<body>

<?php include("conn.php"); ?>

<?php 
	if(isset($_GET['action'])&&$_GET['action']=="logout"){
		unset($_SESSION['user']);
		Header("Location:login.php");
	}
?>


<?php
	if(isset($_POST['submit'])&&$_POST['submit']){
		$get_name="SELECT * FROM `user` where email='$_POST[email]'";
		$query=mysql_query($get_name) or die("Search error!");
		if(!is_array(mysql_fetch_row($query))){
?>

<script type="text/javascript" language="javascript">
	alert("This uesr name does not exists!");	
</script>

<?php        
		}
		
		else{
			$password=mysql_result($query, 0, "password");
			if($password==md5($_POST['password'])){
				$user_array = array(mysql_result($query, 0, "user_id"), 
									mysql_result($query, 0, "user_name"),
									mysql_result($query, 0, "about"),
									mysql_result($query, 0, "head_pic"),
									mysql_result($query, 0, "password"),
									mysql_result($query, 0, "email"),
									mysql_result($query, 0, "first_name"),
									mysql_result($query, 0, "last_name"),
									mysql_result($query, 0, "gender")
									);
				$_SESSION['user'] = $user_array;
?>

				<script type="text/javascript" language="javascript">
                    location.href="index.php";
                </script>

<?php				
			}
			else{
?>

				<script type="text/javascript" language="javascript">
                    alert("Password error!");
                    register_form.account.focus();
                </script>

<?php
			}
		}
	}
?>

<script type="text/javascript" language="javascript">
function checkPost(){
	if(register_form.email_address.value==""){
		alert("Email address can not be empty!");
		login_form.email_address.focus();
		return false;
	}
	if(register_form.password.value==""){
		alert("Password can not be empty!");
		login_form.password.focus();
		return false;
	}
}
</script>

    <div id="wrapper">
    
    	<div id="login" class="logreg">
        	
            <a href="index.php"><img class="big_logo" src="./image/big_logo.png" /></a>
            
            <img class="login_bar" src="./image/login_bar.png" />
            
            <form action="login.php" id="login_form" method="post" onsubmit="return checkPost()" name="login_form">
            	<p><b>Email</b><input class="input_text" name="email" type="text" /></p>
                <p><b>Password</b><input class="input_text" name="password" type="password" /></p>
            	<p><input class="submit_button" type="submit" name="submit" value="Login" /> <a class="to_other" href="register.php">New user to register</a></p>
            </form>
        
        </div>
    
    </div><!--end # wrapper-->


</body>
</html>