<?php include("conn.php"); ?>

<?php
if(isset($_SESSION['user'][0])){ 
$delete_pin_id = $_GET['delete_id'];
$user_id = $_SESSION['user'][0];

$sql="delete from like_pin where user_id = '".$user_id."' and pin_id = '".$delete_pin_id."'";
mysql_query($sql) or die("delete error!!");
}
?>
