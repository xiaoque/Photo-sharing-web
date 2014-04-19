<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/style.css" type="text/css" rel="stylesheet" />
<link href="./css/settings.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Settings - Pinterest</title>
</head>

<body>

    <div id="wrapper">
    	
        <div id="header">
        	<?php include('header.php'); ?>
        </div>
        
 <?php
	
	if(isset($_POST['submit_settings'])&&$_POST['submit_settings']){
		
		$user_name=$_POST['user_name'];
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$gender=$_POST['gender'];
		$about=$_POST['about'];
		
		$user_id = $_SESSION['user'][0];
		
		$sql="update user set user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', gender = '$gender', about = '$about' where user_id = '$user_id'";
		mysql_query($sql) or die("Update error!");
		
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
			location.href="index.php";
</script>

<?php
	}
?>



<script type="text/javascript" language="javascript">
function checkPost(){
	if(settings_form.user_name.value==""){
		alert("User name can not be empty!");
		settings_form.user_name.focus();
		return false;
	}
	
	if(settings_form.first_name.value==""){
		alert("First name can not be empty!");
		settings_form.first_name.focus();
		return false;
	}
	
	if(settings_form.last_name.value==""){
		alert("Last name can not be empty!");
		settings_form.last_name.focus();
		return false;
	}
}
</script>       
		
        
        <div id="main">
        	<div id="info" class="settings">
            	
                
            	<form enctype="multipart/form-data" action="settings.php" class="set_form" id="settings_form" method="post" onsubmit="return checkPost()" name="settings_form">
                	<h3>Eidt Basic Info</h3>
                    <p><b>Email Address</b><?php echo $_SESSION['user'][5]; ?></p>
                    <p><b>User Name</b><input class="input_text" value="<?php echo $_SESSION['user'][1]; ?>" name="user_name" type="text" /></p>
                    <p><b>Password</b><a class="click_button" href="change_password.php">Change My Password</a></p>
                    <p><b>First Name</b><input class="input_text" value="<?php echo $_SESSION['user'][6]; ?>" name="first_name" type="text" /></p>
                    <p><b>Last Name</b><input class="input_text" value="<?php echo $_SESSION['user'][7]; ?>" name="last_name" type="text" /></p>
                    <p><b>Gender</b>
                        <span class="gender_area">
                            <label><input class="input_radio" id="gender_1" checked="true" type="radio" value="male" name="gender"/>Male</label>
                            <label><input class="input_radio"  id="gender_2" type="radio" value="female" name="gender"/>Female</label>
                            <label><input class="input_radio"  id="gender_3" type="radio" value="unspecified" name="gender"/>Unspecified</label>
                        </span>
                    </p>
                    <p><b>Head Portrait</b><a class="click_button" href="change_avatar.php">Change My Head Portrait</a></p>
                    <p><b>About</b><textarea class="input_text" name="about"><?php echo $_SESSION['user'][2]; ?></textarea></p>
                    <p><input id="sub_button" class="click_button" type="submit" name="submit_settings" value="Change And Save" /></p>
                </form>
        	</div>
        </div>
        
		<script type="text/javascript" language="javascript">
                var gender_name = document.getElementsByName('gender');
            </script>
            <?php
                if($_SESSION['user'][8] == "male") {
            ?>
            
            <script type="text/javascript" language="javascript">
                gender_name[0].checked = true;	
            </script>
            
            <?php
                }
                else if($_SESSION['user'][8] == "female") {
            ?>
            
            <script type="text/javascript" language="javascript">
                gender_name[1].checked = true;	
            </script>
            
            <?php
                }
                else if($_SESSION['user'][8] == "unspecified") {
            ?>
            <script type="text/javascript" language="javascript">
                gender_name[2].checked = true;	
            </script>
            <?php
                }
            ?>      
    </div>
	
</body>
</html>