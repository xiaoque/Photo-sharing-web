<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/style.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Add - Pinterest</title>
</head>

<body>

<script type="text/javascript" language="javascript">
function checkPost(){
	if(add_form.board_name.value==""){
		alert("File can not be empty!");
		return false;
	}
}
</script>
	
    <div id="wrapper">
    	
        <div id="header">
        	<?php include('header.php'); ?>
        </div>
        
        
<?php 
	if(isset($_POST['submit'])&&$_POST['submit']){
		$board_name = $_POST['board_name'];
		$cat = $_POST['cat'];
		$user_id = $_SESSION['user'][0];
		$sql="insert into board (board_id,user_id,board_name,board_cat,create_time) values (NULL,'".$user_id."','".$board_name."','".$cat."',now())";
		mysql_query($sql) or die("Add Board Error!!");
		Header("Location:add.php");
	}
?>

        
        <div id="main">
        	<div id="content">
            	<div id="add_board" class="add_page">
                    <form action="add_board.php" method="post" onsubmit="return checkPost()" name="add_form">
                        <h3>Add a Board</h3>
                        <p><b>Board Name</b><span><input name="board_name" type="text"></span></p>
                        <p><b>Board Category</b>
                        <span>
                        	<select name="cat">
                            	<option value="art">Art</option>
                                <option value="architecture">Architecture</option>
                                <option value="car">Car</option>
                                <option value="design">Design</option>
                                <option value="diy">DIY</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="food">Food</option>
                                <option value="life">Life</option>
                                <option value="product">Product</option>
                                <option value="sports">Sports</option>
                                <option value="other">Other</option>
                            </select>
                        </span>
                        </p>
                        <p><input class="submit_button" name="submit" type="submit" value="Add"></p> 
                    </form>
            	</div>
        	</div>
        </div>
    
    </div>
	
</body>
</html>