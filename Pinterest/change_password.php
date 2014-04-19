<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/style.css" type="text/css" rel="stylesheet" />
<link href="./css/settings.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Change My Password - Pinterest</title>
</head>

<body>

    <div id="wrapper">
    	
        <div id="header">
        	<?php include('header.php'); ?>
        </div>
        
<?php

	if(isset($_POST['submit_password'])&&$_POST['submit_password']){
		
		$user_id = $_SESSION['user'][0];
		$old_password = md5($_POST['old_password']);
		$password = md5($_POST['new_password']);
		
		if($old_password != $_SESSION['user'][4]) {
			
?>

<script type="text/javascript" language="javascript">
			alert("Your old password is wrong!");
</script>

<?php		
		}
		
		else {
			$sql="update user set password = '$password' where user_id = '$user_id'";
			mysql_query($sql) or die("Update error!");
			
			unset($_SESSION['user']);
			$get_user="select * from user where user_id = '$user_id'";
			$query=mysql_query($get_user);
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
			location.href="settings.php";
</script>

<?php
		}
	}
?>



<script type="text/javascript" language="javascript">
function checkPost(){
	
	if(password_form.new_password.value==""){
		alert("New password can not be empty!");
		password_form.new_password.focus();
		return false;
	}
	
	if(password_form.confirm_new_password.value==""){
		alert("Confirm password address can not be empty!");
		password_form.confirm_new_password.focus();
		return false;
	}
	
	if(password_form.new_password.value!=password_form.confirm_new_password.value){
		alert("The two passwords you typed do not match!");
		password_form.confirm_new_password.focus();
		return false;
	}
}
</script>       
		
        
        <div id="main">
        	<div id="change_pw" class="settings">
            	<form enctype="multipart/form-data" action="change_password.php" class="set_form" method="post" onsubmit="return checkPost()" name="password_form">
                	<h3>Change My Password</h3>
                    <p><b>Old Password</b><input class="input_text" name="old_password" type="password" /></p>
                    <p><b>New Password</b><input class="input_text" name="new_password" type="password" /></p>
                    <p><b>Confirm New Password</b><input class="input_text" name="confirm_new_password" type="password" /></p>
                    <p><input id="sub_button" class="click_button" type="submit" name="submit_password" value="Change And Save" /></p>
                </form>
        	</div>
        </div>
    </div>
	
</body>
</html>