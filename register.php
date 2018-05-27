<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta name="description" content="LAMP | Server">
<title> Techbook | Welcome</title>
<link rel="stylesheet" href="style.css">
<script src="style.js"></script> 
</head>
<body>
    <div id="container">

        <div id="header">
            <h1>Techbook <span style="font: 24px sans-serif;">| Advanced Systems</span></h1>
        </div>

        <div id="navbar">
            <a href="index.html">Home</a>
            <?php
                session_start();
                if( $_SESSION['logged_in'] == true ){
                    echo '<a href="profile.php">Profile</a>';
                    echo '<a class="current" href="register.php">New Account</a>';
                    echo '<a href="delete.php">Delete Account</a>';
                    echo '<a href="upload.php">Upload Files</a>';
                    echo '<a href="logout.php">Log Out</a>';
                }
                else{
                    echo '<a href="index.php">Login</a>';
                    echo '<a href="register.php">New Account</a>';
                }
            ?>
        </div>

        <div id="box-one">
            <div id="menu">
                <div id="menu-content">
                    <a href="index.html">Home</a>
                    <?php
                        session_start();
                        if( $_SESSION['logged_in'] == true ){
                            echo '<a href="profile.php">Profile</a>';
                            echo '<a class="current" href="register.php">New Account</a>';
                            echo '<a href="delete.php">Delete Account</a>';
                            echo '<a href="upload.php">Upload Files</a>';
                            echo '<a href="logout.php">Log Out</a>';
                        }
                        else{
                            echo '<a href="index.php">Login</a>';
                            echo '<a href="register.php">New Account</a>';
                       }
                    ?>
                </div>
            </div>
        </div>

        <div id="main">

            <div id="box-two">
				<h1 style="color:rgba(10,10,50,1);">Please create new account</h1><br><br>
    	        <form action="register.php" method="POST">
                    First Name<br><input class="input-box" type="text" name="first" placeholder="First Name"><br><br>
            	    Last Name<br><input class="input-box" type="text" name="last" placeholder="Last Name"><br><br>
                    User ID<br><input class="input-box" type="text" name="uid" placeholder="User Name"><br><br>
                	Password<br><input class="input-box" type="password" name="pwd" placeholder="Password"><br><br>
                	<br><button type="submit" class="main-button">Create</button><br>
            	</form><br>
                <?php
                    include "create_user.php";
				?>
            </div>

        </div> <!-- End main -->

        <div id="footer">
            <h3>Techbook | Welcome &copy;2017</h3>
        </div>

    </div> <!-- End contrainer -->

</body>
</html>



