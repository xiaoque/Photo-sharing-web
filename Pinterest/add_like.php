<?php include("conn.php"); ?>

<?php
if(isset($_SESSION['user'][0])){ 
	$curr_user_id = $_SESSION['user'][0];
	$like_pin_id = $_GET['like_id'];
	
	$judge_sql = "select * from like_pin where user_id = '$curr_user_id' and pin_id = '$like_pin_id'";
	$judge_query = mysql_query($judge_sql);
	$result = mysql_fetch_array($judge_query);
	
	if(empty($result)) {
	
		$sql="insert into like_pin(like_id,user_id,like_time,pin_id) values (NULL,'".$curr_user_id."',now(),'".$like_pin_id."')";
		mysql_query($sql) or die("add_like error!!");
					
	}
}
?>
