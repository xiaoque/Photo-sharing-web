<?php include("conn.php"); ?>

<script type="text/javascript" language="javascript">
function search_pin() {
	var search_text = document.getElementById('search_input').value;
	if(search_text == "Search") {
		return false;
	}
	window.location.href = "search.php?text=" + search_text;
}
</script>

<div id="header_field">
    
    <div id="menu">
        <ul>
        	<?php
				if(isset($_SESSION['user'][0])){ 
			?>
            <li><a href="add.php">Add + </a></li>
            <?php
				}
			?>
            <li class="sec_menu" id="about_menu">
            	<a href="about.php">About <img class="triangle" src="./image/triangle.png" /></a>
                <ul>
                	<li><a href="help.php">Help</a></li>
                    <li><a href="about.php">Copyright</a></li>
                </ul>
            </li>
            <li class="sec_menu" id="profile_menu">
            	<?php
					if(!isset($_SESSION['user'][0])){ 
				?>
                
                <a href="login.php">Login</a>
                
                <?php 
                }
                else{
                ?>
            
            
            	<a href="pins.php"><span class="head_pic_menu"><img class="head_pic" src="./head_pics/<?php  echo $_SESSION['user'][3]; ?>" /><?php echo $_SESSION['user'][1]; ?><img class="triangle" src="./image/triangle.png" /></span></a>
            	<ul>
                	<li><a href="boards.php?id=<?php echo $_SESSION['user'][0]; ?>">Boards</a></li>
                    <li><a href="pins.php?id=<?php echo $_SESSION['user'][0]; ?>">Pins</a></li>
                    <li class="divide"><a href="likes.php?id=<?php echo $_SESSION['user'][0]; ?>">Likes</a></li>
                    <li><a href="settings.php?id=<?php echo $_SESSION['user'][0]; ?>">Settings</a></li>
                    <li><a href="login.php?action=logout">Logout</a></li>
                </ul>
                
                <?php } ?> 
                
            </li>
        </ul>
    </div>
    
    <div id="logo">
        <a href="index.php"><img src="image/Pinterest_Logo.png" /></a>
    </div>
    
    <div id="search_field">
        <div id="search_form">
            <input id="search_input" type="text" value="Search" onfocus="if(value=='Search'){value=''}" onblur="if(value==''){value='Search'}" />
            <a onclick="search_pin()" type="submit"><img src="image/search-icon.jpg" /></a>
        </div>
    </div>
    
</div>
