<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="./css/style.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Add - Pinterest</title>
</head>

<body>
<?php
	$max_file_size=5000000;
	$destination_folder="./pins/";
	$uptypes=array('image/bmp','image/jpg','image/png','image/jpeg','image/bmp');
	$imgpreview=1;
	$imgpreviewsize=1;
?>

<script type="text/javascript" language="javascript">
function checkPost(){
	if(upload_form.upfile.value==""){
		alert("File can not be empty!");
		return false;
	}
	if(upload_form.board.value=="-1"){
		alert("Please choose a board!");
		return false;
	}
}
</script>
	
    <div id="wrapper">
    	
        <div id="header">
        	<?php include('header.php'); ?>
        </div>
        
        <div id="main">
        	<div id="content">
            	<div id="add" class="add_page">
                    <form enctype="multipart/form-data" method="post" onsubmit="return checkPost()" name="upload_form">
                        <h3>Add a pin</h3>
                        <input class="upfile_text" name="upfile" type="file">
                        <p><b>Borad</b>
                        <select name="board">
							<option value="-1">Choose a Board</option>
						<?php
							$user_id = $_SESSION['user'][0];
							$board_sql = "select * from `board` where user_id = '$user_id'";
							$board_query =  mysql_query($board_sql);
							while($row=mysql_fetch_array($board_query)){
						?>
                        	<option value="<?php echo $row['board_id'];?>"><?php echo $row['board_name'];?></option>
                        <?php
							}
						?>
                        </select>
                        </p>
                        <b>Describe(Up To 100 Letters)</b>
                        <p><textarea class="description_text" name="description"></textarea></p>
                        <input class="submit_button" type="submit" value="Upload"> 
                        <a class="add_board_link" href="add_board.php">Add a Board</a>
                    </form>
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
                            {
                                echo "<font color='red'>File Not Exists！</font>";
                                exit;
                            }
                            $file = $_FILES['upfile'];
                            if($max_file_size < $file['size'])
                            {
                                echo "<font color='red'>File So Big！</font>";
                                exit;
                            }
                            if(!in_array($file['type'], $uptypes))
                            {
                                echo "<font color='red'>Only upload Picture！</font>";
                                exit;
                            }
                            if(!file_exists($destination_folder)) {
                                mkdir($destination_folder);
                            }
                            $filename=$file['tmp_name'];
                            $image_size = getimagesize($filename);
                            $pinfo=pathinfo($file['name']);
                            $ftype=$pinfo['extension'];
                            $destination = $destination_folder.time().".".$ftype;
                            if (file_exists($destination) && $overwrite != true)
                            {
                                echo "<font color='red'>The Same Niame！</a>";
                                exit;
                            }
                        
                            if(!move_uploaded_file ($filename, $destination))
                            {
                                echo "<font color='red'>Transfer Fail！</a>";
                                exit;
                            }
                        
                            $pinfo=pathinfo($destination);
                            $fname=$pinfo['basename'];
							
							$user_id = $_SESSION['user'][0];
							$description=$_POST['description'];
							$board=$_POST['board'];
							$sql="insert into pin (pin_id,user_id,board_id,image_name,description,pin_time) values (NULL,'".$user_id."','".$board."','".$fname."','".$description."',now())";
							mysql_query($sql) or die("Insert error!!");
                        
                            /*if($imgpreview==1)
                            {
                                echo "<br>Picture Preview:<br>";
                                echo "<a href=\"".$destination."\" target='_blank'><img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
                                echo " alt=\"Preview:\rFile name:".$destination."\rUpload time:\" border='0'></a>";
                            }*/
					?>
					<script type="text/javascript" language="javascript">
						location.href="index.php";
					</script>
                    
                    <?php		
                        }
                    ?>
            	</div>
        	</div>
        </div>
    
    </div>
	
</body>
</html>