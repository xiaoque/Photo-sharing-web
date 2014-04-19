<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/logreg.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Register - Pinterest</title>
</head>

<body>

<?php include("conn.php"); ?>

<?php
	$max_file_size=5000000;
	$destination_folder="./head_pics/";
	$uptypes=array('image/bmp','image/jpg','image/png','image/jpeg','image/bmp');
	$imgpreview=1;
	$imgpreviewsize=1/3;
	
	if(isset($_POST['submit'])&&$_POST['submit']){
		
		$email=$_POST['email'];
		$user_name=$_POST['user_name'];
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$gender=$_POST['gender'];
		$password=md5($_POST['password']);
		$about=$_POST['about'];
		
		$get_name="select * from user where email='$_POST[email]'";
		$srch=mysql_query($get_name) or die("Search error!");
		
		if(is_array(mysql_fetch_row($srch))){
?>

<script type="text/javascript" language="javascript">
			alert("You input the user name already exists, please re-entry!");	
</script>

<?php        
		}
		
		else{
			if (!is_uploaded_file($_FILES["head_pic"]['tmp_name']))
			{
				echo "<font color='red'>File Not Exists！</font>";
				exit;
			}
			$file = $_FILES['head_pic'];
			if($max_file_size < $file['size'])
			{
				echo "<font color='red'>File So Big！</font>";
				exit;
			}
			if(!in_array($file['type'], $uptypes))
			{
				echo "<font color='red'>Only upload Picture！</font>";
				exit;
			}
			if(!file_exists($destination_folder)) {
				mkdir($destination_folder);
			}
			$filename=$file['tmp_name'];
			$image_size = getimagesize($filename);
			$pinfo=pathinfo($file['name']);
			$ftype=$pinfo['extension'];
			$destination = $destination_folder.time().".".$ftype;
			if (file_exists($destination) && $overwrite != true)
			{
				echo "<font color='red'>The Same Name！</a>";
				exit;
			}
		
			if(!move_uploaded_file ($filename, $destination))
			{
				echo "<font color='red'>Transfer Fail！</a>";
				exit;
			}
		
			$pinfo=pathinfo($destination);
			$fname=$pinfo['basename'];
			
			$sql="insert into user (user_id,email,user_name,first_name,last_name,password,about,gender,head_pic) values (null,'".$email."','".$user_name."','".$first_name."','".$last_name."','".$password."','".$about."','".$gender."','".$fname."')";
			mysql_query($sql) or die("Register error!!");
			
			unset($_SESSION['user']);
			$query=mysql_query($get_name);
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
	}
?>



<script type="text/javascript" language="javascript">
function checkPost(){
	if(register_form.email.value==""){
		alert("Email address can not be empty!");
		register_form.email.focus();
		return false;
	}
	
	if(register_form.email.value.indexOf('@',0)==-1){
		alert("You have input an wrong email address!");
		register_form.email.focus();
		return false;
	}
	
	if(register_form.user_name.value==""){
		alert("User name can not be empty!");
		register_form.user_name.focus();
		return false;
	}
	
	if(register_form.first_name.value==""){
		alert("First name can not be empty!");
		register_form.first_name.focus();
		return false;
	}
	
	if(register_form.last_name.value==""){
		alert("Last name can not be empty!");
		register_form.last_name.focus();
		return false;
	}
	
	if(register_form.password.value==""){
		alert("Password can not be empty!");
		register_form.password.focus();
		return false;
	}
	
	if(register_form.confirm_password.value==""){
		alert("Confirm Password can not be empty!");
		register_form.confirm_password.focus();
		return false;
	}
	
	if(register_form.password.value!=register_form.confirm_password.value){
		alert("The two passwords you typed do not match!");
		register_form.confirm_password.focus();
		return false;
	}
	
	if(register_form.head_pic.value==""){
		alert("Head Portrait can not be empty!");
		return false;
	}
}
</script>

    <div id="wrapper">
    
    	<div id="register" class="logreg">
        	
           <a href="index.php"><img class="big_logo" src="./image/big_logo.png" /></a>
            
            <form enctype="multipart/form-data" action="register.php" id="register_form" method="post" onsubmit="return checkPost()" name="register_form">
            	<p><b>Email Address</b><input class="input_text" name="email" type="text" /></p>
                <p><b>User Name</b><input class="input_text" name="user_name" type="text" /></p>
                <p><b>Password</b><input class="input_text" name="password" type="password" /></p>
                <p><b>Comfirm Password</b><input class="input_text" name="confirm_password" type="password" /></p>
                <p><b>First Name</b><input class="input_text" name="first_name" type="text" /></p>
                <p><b>Last Name</b><input class="input_text" name="last_name" type="text" /></p>
                <p><b>Gender</b>
                	<span class="gender_area">
                        <label><input class="input_radio" id="gender_1" checked="true" type="radio" value="male" name="gender"/>Male</label>
                        <label><input class="input_radio"  id="gender_2" type="radio" value="female" name="gender"/>Female</label>
                        <label><input class="input_radio"  id="gender_3" type="radio" value="unspecified" name="gender"/>Unspecified</label>
                    </span>
                </p>
                <p><b>Head Portrait</b><input class="input_file" name="head_pic" type="file"></p>
                <p><b>About</b><textarea class="input_text" name="about"></textarea></p>
            	<p><input class="submit_button" type="submit" name="submit" value="Register" /> <a class="to_other" href="login.php">User to login</a></p>
            </form>
        
        </div>
    
    </div><!--end # wrapper-->


</body>
</html>