<?php include("conn.php"); ?>

<?php
if(isset($_SESSION['user'][0])){ 
	$delete_pin_id = $_GET['delete_id'];
	
	$sql="delete from pin where pin_id = '".$delete_pin_id."'";
	mysql_query($sql) or die("delete error!!");
	$sql="delete from like_pin where pin_id = '".$delete_pin_id."'";
	mysql_query($sql) or die("delete error!!");
	$sql="delete from comment where pin_id = '".$delete_pin_id."'";
	mysql_query($sql) or die("delete error!!");
}
?>
