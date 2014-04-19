<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/style.css" type="text/css" rel="stylesheet" />
<link href="./css/profile.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Boards - Pinterest</title>
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
                            <li><a class="current_page" href=boards.php?user_id=<?php echo $curr_user_id?>>Boards</a></li>
                            <li><a href=pins.php?user_id=<?php echo $curr_user_id?>>Pins</a></li>
                            <li><a href=likes.php?user_id=<?php echo $curr_user_id?>>Likes</a></li>
                        </ul>
                        
                        <ul class="follow_link">
                            <li><a href=followers.php?user_id=<?php echo $curr_user_id?>>Followers</a></li>
                            <li><a href=following.php?user_id=<?php echo $curr_user_id?>>Following</a></li>
                        </ul>
                    </div>
            	</div>
            </div>
            
            <div id="content">
                <div id="board">
                	<ul>
						<?php
                            $BOARD_SQL = "select * from board where user_id = '$curr_user_id' order by board_id desc";
                            $board_query = mysql_query($BOARD_SQL);
                            while($board_row = mysql_fetch_array($board_query)) {
                                $board_id = $board_row['board_id'];
                                $board_name = $board_row['board_name'];
                                
                                $PIN_SQL = "select * from pin where board_id = '$board_id' order by pin_id desc";
                                $pin_query = mysql_query($PIN_SQL);
                                
                                $pin_num = 0;
                        ?>
                                
                                <li>
                                
                                    <div class="board_cover">        
                            <?php
                                        while(($pin_row = mysql_fetch_array($pin_query)) & $pin_num < 1) {
                                            $image_name = $pin_row['image_name'];
                                            $pin_num++;
                            ?>
                                            <a id="cover_<?php echo $board_id; ?>" href="board_display.php?user_id=<?php echo $curr_user_id; ?>&board_id=<?php echo $board_id;?>"><img src="./pins/<?php echo $pin_row['image_name'];?>"/></a>
                                	
                                
                        
                            <?php
                                        }
							?>
                            
                                    </div>
                            		
                                    <a class="board_button" href="board_display.php?user_id=<?php echo $curr_user_id; ?>&board_id=<?php echo $board_id;?>"><?php echo $board_name;?></a>
                            	
                                </li>
                            <?php
                                }
                            ?>
                	</ul>
    			</div>
            </div><!--end of #content-->
        
        
        </div><!--end of #main-->
    
    </div><!--end of #wrapper-->
	
</body>
</html>