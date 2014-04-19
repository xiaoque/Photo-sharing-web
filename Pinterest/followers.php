<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/style.css" type="text/css" rel="stylesheet" />
<link href="./css/profile.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Followers - Pinterest</title>
</head>

<body>
	
    <div id="wrapper">
    	
        <div id="header">
        	<?php include('header.php'); ?>
        </div>
        
        <?php
			if(isset($_GET['user_id'])){
				$curr_user_id = $_GET['user_id'];
			}
			else{
				$curr_user_id = $_SESSION['user'][0];
			}
		?>
        
        <div id="main">
        	<div id="profile_header">
            	<?php include('profile_header.php'); ?>
                <div id="page_menu">
                    <div class="page_menu_body">
                        <ul class="user_link">
                            <li><a href="boards.php?user_id=<?php echo $curr_user_id; ?>">Boards</a></li>
                            <li><a href="pins.php?user_id=<?php echo $curr_user_id; ?>">Pins</a></li>
                            <li><a href="likes.php?user_id=<?php echo $curr_user_id; ?>">Likes</a></li>
                        </ul>
                        
                        <ul class="follow_link">
                            <li><a class="current_page" href="follwers.php?user_id=<?php echo $curr_user_id; ?>" href="followers.php">Followers</a></li>
                            <li><a href="following.php?user_id=<?php echo $curr_user_id; ?>">Following</a></li>
                        </ul>
                    </div>
            	</div>
            </div>
            
            <div id="follow">
            	<ul>
            	<?php 
					$FOLLOW_SQL = "select * from follow where followed_user_id = '$curr_user_id' order by follow_id desc";
					$follow_query = mysql_query($FOLLOW_SQL);
					while($follow_row=mysql_fetch_array($follow_query)) {
						$following_user_id = $follow_row['following_user_id'];
						
						$USER_SQL = "select * from user where user_id = '$following_user_id'";
						$user_query = mysql_query($USER_SQL);
						while($user_row=mysql_fetch_array($user_query)) {
							
				?>
                <li>
            				<div class="follow_head">
                            	<a class="head_link" href="pins.php?user_id=<?php echo $following_user_id; ?>"><img class="user_head" src="./head_pics/<?php echo $user_row['head_pic'];?>" /></a>
                            </div>
                            <a href="pins.php?user_id=<?php echo $following_user_id; ?>"><?php echo $user_row['user_name'];?></a>
                </li>
                <?php
						}
					}
				?>
                </ul>
            </div><!--end of #follow-->
            
        </div><!--end of #main-->
    
    </div>
	
</body>
</html>