<?php include("conn.php"); ?>

<?php
if(isset($_SESSION['user'][0])){ 
$delete_user_id = $_GET['delete_id'];
$user_id = $_SESSION['user'][0];

$sql="delete from follow where following_user_id = '".$user_id."' and followed_user_id = '".$delete_user_id."'";
mysql_query($sql) or die("delete error!!");
}
?>
