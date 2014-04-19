<?php include("conn.php"); ?>

<?php
if(isset($_SESSION['user'][0])){ 
	$curr_user_id = $_SESSION['user'][0];
	$add_user_id = $_GET['add_id'];
	
	$sql="insert into follow(follow_id,following_user_id,followed_user_id,follow_time) values (NULL,'".$curr_user_id."','".$add_user_id."',now())";
	mysql_query($sql) or die("add_like error!!");
					
}
?>
