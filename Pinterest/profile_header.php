<script type="text/javascript" language="javascript">
function add_follow(get_user_id) {
	
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","add_follow.php?add_id="+get_user_id,false);
	xmlhttp.send();
	
	window.location.reload();
}

function delete_follow(get_user_id) {
	
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","delete_follow.php?delete_id="+get_user_id,false);
	xmlhttp.send();
	window.location.reload();
}
</script>

<div id="profile_header_field">
	<div class="profile_header_body">
        <div class="user_info">
<?php
	if(isset($_GET['user_id'])){
	$p_curr_user_id = $_GET['user_id'];
            	
	$SQL_user="SELECT * FROM `user` where user_id = '$p_curr_user_id'order by user_id desc";
	$u_query=mysql_query($SQL_user);
	while($u_row=mysql_fetch_array($u_query)){
	$pic=$u_row['head_pic'];	
	$name=$u_row['user_name'];
	$describe=$u_row['about'];
}
}
	else {
	$p_curr_user_id = $_SESSION['user'][0];
  	$pic= $_SESSION['user'][3];
	$name=$_SESSION['user'][1];
	$describe=$_SESSION['user'][2];
}
	
?>
            <img class="head_pic" src="./head_pics/<?php  echo $pic; ?>" />    
            
            <div class="head_info">
                <h3 class="user_name"><?php echo $name; ?></h3>
                <h5 class="describe"><?php echo $describe; ?></h5>
            </div>
            
			<?php 
				if(isset($_SESSION['user'][0])) {
               		if($p_curr_user_id != $_SESSION['user'][0]) {
						$login_user_id = $_SESSION['user'][0];
						$JUDGE_FOLLOW_SQL = "select * from follow where following_user_id = '$login_user_id' and followed_user_id = '$p_curr_user_id'";
						$judge_follow_query = mysql_query($JUDGE_FOLLOW_SQL);
						$judge_follow_row = mysql_fetch_array($judge_follow_query);
						if(empty($judge_follow_row)) {
            ?>
                	
                			<a href="javascript:void(0);" id="not_follow_button" class="follow_button" onclick="add_follow(<?php echo $p_curr_user_id; ?>)">Follow</a>
                    
            <?php
						}
						else {
			?>
            
            				<a href="javascript:void(0);" id="already_follow_button" class="follow_button" onclick="delete_follow(<?php echo $p_curr_user_id; ?>)">Unfollow</a>
            
            <?php
						}
                	}
				}
            ?>
            
        </div>
        
    </div>
</div>