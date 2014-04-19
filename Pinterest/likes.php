<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="./css/style.css" type="text/css" rel="stylesheet" />
<link href="./css/profile.css" type="text/css" rel="stylesheet" />
<script src="js/jquery-1.6.js" type="text/javascript" language="javascript"></script>
<script src="js/jquery.masonry.min.js.js" type="text/javascript" language="javascript"></script>

<script type="text/javascript" src="js/jquery.shadow.js"></script>
<script type="text/javascript" src="js/jquery.ifixpng.js"></script>

<script type="text/javascript" src="js/jquery.fancyzoom.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Boards - Pinterest</title>
</head>

<body>
<script type="text/javascript" language="javascript">
function delete_like(get_pin_id) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","delete_like.php?delete_id="+get_pin_id,false);
	xmlhttp.send();
	window.location.reload();
}

function delete_pin(get_pin_id) {
	
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","delete_pin.php?delete_id="+get_pin_id,false);
	xmlhttp.send();
	window.location.reload();
}

function button_appear(pin_id) {
	var unlike_button = "unlike_pin_" + pin_id;
	var delete_button = "delete_pin_" + pin_id;
	document.getElementById(unlike_button).style.display = 'block';
	document.getElementById(delete_button).style.display = 'block';
}

function button_disappear(pin_id) {
	var unlike_button = "unlike_pin_" + pin_id;
	var delete_button = "delete_pin_" + pin_id;
	document.getElementById(unlike_button).style.display = 'none';
	document.getElementById(delete_button).style.display = 'none';
}
</script>

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
        
        <?php
			
			if(isset($_POST['comment_submit'])&&$_POST['comment_submit']){
				$comment_pin_id = $_POST['comment_pin_id'];
				$comment_text = $_POST['comment_text'];
				
				$current_user_id =  $_SESSION['user'][0];
				
				$sql="insert into comment (comment_id, pin_id, user_id, content, comment_time) values (null,'".$comment_pin_id."','".$current_user_id."','".$comment_text."',now())";
				mysql_query($sql) or die("Comment error!");
		?>
        
        <script type="text/javascript" language="javascript">
			window.location.href= "likes.php?id=" + <?php echo $curr_user_id; ?>;
		</script>
        
        <?php
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
                            <li><a class="current_page" href="likes.php?user_id=<?php echo $curr_user_id; ?>">Likes</a></li>
                        </ul>
                        
                        <ul class="follow_link">
                            <li><a href="followers.php?user_id=<?php echo $curr_user_id; ?>">Followers</a></li>
                            <li><a href="following.php?user_id=<?php echo $curr_user_id; ?>">Following</a></li>
                        </ul>
                    </div>
            	</div>
            </div>
            
        	<div id="content">
                 <div id="likes">
                    <div id="pin_dinplay" class="pin">
                        <ul>
                            <!--<li id="recent">
                                <h3>Recent Activity</h3>
                            </li>-->
                            <?php
                                $LIKE_SQL="SELECT * FROM `like_pin` where user_id = '$curr_user_id' order by like_id desc";
                                $like_query=mysql_query($LIKE_SQL);
                                while($like_row=mysql_fetch_array($like_query)){
                                    $like_pin_id = $like_row['pin_id'];
                                    $unlike_button = "unlike_pin_".$like_pin_id;
                                    $delete_button = "delete_pin_".$like_pin_id;
                                    
                                    $PIN_SQL="SELECT * FROM `pin` where pin_id = '$like_pin_id' order by pin_id desc";
                                    $pin_query=mysql_query($PIN_SQL);
                                    while($pin_row=mysql_fetch_array($pin_query)){
                                        $board_id = $pin_row['board_id'];
                                        $pin_user_id = $pin_row['user_id'];
                                        
                                        $BOARD_SQL="SELECT * FROM `board` where board_id = '$board_id'";
                                        $board_query=mysql_query($BOARD_SQL);
                                        while($board_row=mysql_fetch_array($board_query)){
                                            $cur_board_name = $board_row['board_name'];
											$cur_board_id = $board_row['board_id'];
                                        }
                            ?>
                            
                            
                            <li class="small_pin" onmouseover="button_appear('<?php echo $pin_row['pin_id']; ?>')" onmouseout="button_disappear('<?php echo $pin_row['pin_id']; ?>')">
                            
                            <?php
                                if(isset($_SESSION['user'][0])){
                                    
                            ?>
                                <a id="<?php echo $unlike_button; ?>" class="like_button" href="javascript:void(0);" onclick="delete_like(<?php echo $pin_row['pin_id']; ?>)">Unlike</a>
                            <?php 
                                    if($_SESSION['user'][0] == $pin_user_id) {
                            ?>
                                <a id="<?php echo $delete_button; ?>" class="delete_button" href="javascript:void(0);" onclick="delete_pin(<?php echo $pin_row['pin_id']; ?>)">Delete</a>
                            <?php 	} 
                                }
                            ?>
                                 <a href="./pins/<?php echo $pin_row['image_name']; ?>"><img src="./pins/<?php echo $pin_row['image_name'];?>"/></a>
    
                                <p class="pin_text"><?php echo $pin_row['description']; ?></p></a>
    
                            <?php
                                    
                                    $USER_SQL="SELECT * FROM `user` where user_id = '$pin_user_id'";
                                    $user_query=mysql_query($USER_SQL);
                                    while($user_row=mysql_fetch_array($user_query)){
                                        
                            ?>
                            
                                <div class="pin_info">
                                    <div class="pin_user_info">
                                        <a href="pins.php?user_id=<?php echo $user_row['user_id']; ?>"><img class="user_head" src="./head_pics/<?php echo $user_row['head_pic'];?>" /></a>
                                        
                                        <p class="comment_text"> <b><a class="user_name_link" href="pins.php?user_id=<?php echo $user_row['user_id']; ?>"><?php echo $user_row['user_name'];?></a> </b>pin onto <b><a class="user_name_link" href="board_display.php?user_id=<?php echo $pin_user_id; ?>&board_id=<?php echo $cur_board_id;?>"><?php echo $cur_board_name;?></a></b> board</p>
                                    </div>
                                    
                                    <ul class="comment_display">
                                    <?php
                                        $COMMENT_SQL="SELECT * FROM `comment` where pin_id = '$like_pin_id' order by comment_id desc";
                                        $comment_query=mysql_query($COMMENT_SQL);
                                        while($comment_row=mysql_fetch_array($comment_query)){	
                                    ?>
                                        <li>
                                        <?php
                                            $comment_user_id = $comment_row['user_id'];
                                            $comment_content = $comment_row['content'];
                                            $COMMENT_USER_SQL="SELECT * FROM `user` where user_id = '$comment_user_id'";
                                            $comment_user_query=mysql_query($COMMENT_USER_SQL);
                                            while($comment_user_row=mysql_fetch_array($comment_user_query)){
                                                $comment_user_pic = $comment_user_row['head_pic'];
                                                $comment_user_name = $comment_user_row['user_name'];
                                        ?>
                                        <a href="pins.php?user_id=<?php echo $comment_user_id; ?>"><img class="user_head" src="./head_pics/<?php echo $comment_user_pic; ?>" /></a>
                                        <p class="comment_text"><b><a class="user_name_link" href="pins.php?user_id=<?php echo $comment_user_id; ?>"><?php echo $comment_user_name; ?></a></b></p>
                                        <p class="comment_text"><?php echo $comment_content;?></p>             
                                        </li>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </ul>
                                    
                                    <?php if(isset($_SESSION['user'][0])){ ?>
                                            <form id="comment_form" action="likes.php" name="comment_form" onsubmit="check_comment()" method="post">
                                                <img class="user_head" src="./head_pics/<?php echo $_SESSION['user'][3]; ?>" />
                                                <input type="hidden" value="<?php echo $like_pin_id; ?>" name="comment_pin_id" />
                                                <textarea rows="1" name="comment_text"></textarea>
                                                <input type="submit" name="comment_submit" id="comment_button" value="comment" />
                                            </form>
                                
                                
                                <?php
                                            }
                                        }
                                    }
                                ?>
                                
                                </div>
                                
                            </li>
                            
                            <?php 
                                    }
                            ?>
                            
                        </ul>
                     </div>  
                     
				</div><!--end #likes-->
            </div><!--end #content-->
            
        </div><!--end of #main-->
    
    </div>
<script type="text/javascript">

$(function() {
	$.fn.fancyzoom.defaultsOptions.imgDir='./pins/';

	$('#gallery a').fancyzoom(); 

	$('a.tozoom').fancyzoom({Speed:1000});
	$('a').fancyzoom({overlay:0.8});
	$('img.fancyzoom').fancyzoom();
});


$(document).ready(function(){
	$('#about_menu ul li').mouseover(function() {
		$('#about_menu').css('background','#DDDDDD');
	});
	$('#about_menu ul li').mouseout(function() {
		$('#about_menu').css('background','none');
	});
	
	$('#profile_menu ul li').mouseover(function() {
		$('#profile_menu').css('background','#DDDDDD');
	});
	$('#profile_menu ul li').mouseout(function() {
		$('#profile_menu').css('background','none');
	});

});

/*
$(function(){
   $('#pin_dinplay ul').masonry({
      //options 设置选项
      itemSelector : '.small_pin',	//class 选择器
      columnWidth : 240 ,			//一列的宽度 Integer
	  isAnimated:true,				//使用jquery的布局变化  Boolean
	  animationOptions:{
	  //jquery animate属性 渐变效果  Object { queue: false, duration: 500 }
	  },
	  gutterWidth:0,				//列的间隙 Integer
	  isFitWidth:true,				// 适应宽度   Boolean
	  isResizableL:true,			// 是否可调整大小 Boolean
	  isRTL:false,					//使用从右到左的布局 Boolean
  });
});*/

var $main= $('#pin_dinplay ul');
$main.imagesLoaded(function(){
  $main.masonry({
    itemSelector : '.small_pin',
    columnWidth : 240
  });
});

</script>
	
</body>
</html>