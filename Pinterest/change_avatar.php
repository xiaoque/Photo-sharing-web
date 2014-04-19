<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/style.css" type="text/css" rel="stylesheet" />
<link href="./css/settings.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Change Head Portrait - Pinterest</title>
</head>

<body>

    <div id="wrapper">
    	
        <div id="header">
        	<?php include('header.php'); ?>
        </div>
        
 <?php
 
 	$max_file_size=5000000;
	$destination_folder="./head_pics/";
	$uptypes=array('image/bmp','image/jpg','image/png','image/jpeg','image/bmp');
	$imgpreview=1;
	$imgpreviewsize=1/3;
	
	if(isset($_POST['submit_avatar'])&&$_POST['submit_avatar']) {
		
		$user_id = $_SESSION['user'][0];
		
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
		
		$sql="update user set head_pic = '$fname' where user_id = '$user_id'";
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
?>
<script type="text/javascript" language="javascript">
function checkPost(){
	if(avatar_form.head_pic.value==""){
		alert("Head Portrait can not be empty!");
		return false;
	}
}
</script>       
		
        
        <div id="main">
        	<div id="info" class="settings">
            	
                
            	<form enctype="multipart/form-data" action="change_avatar.php" class="set_form" id="settings_form" method="post" onsubmit="return checkPost()" name="avatar_form">
                	<h3>Change My Head Portrait</h3>
                     <p><b>Head Portrait</b><input class="input_file" name="head_pic" type="file"></p>
                    <p><input id="sub_button" class="click_button" type="submit" name="submit_avatar" value="Change And Save" /></p>
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