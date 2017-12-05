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

        <div id="video_container">
            <video src="assets/video/movie.mp4" width="100%" autoplay loop muted>
            </video>
        </div>

        <div id="header">
            <h1>Techbook <span style=" font: 24px sans-serif;">| Advanced </span></h1>
        </div>

        <div id="navbar">
            <a href="index.html">Home</a>
            <a class="current" href="login.php">Login</a></li>
            <a href="register.php">New Account</a>
        </div>

        <div id="main">

            <div id="box-one">
                <div id="menu">
                    <button onclick="menu_click()" id="menu-button">Menu</button>
                    <div id="menu-content">
                        <a class="current" href="index.html">Home</a>
                        <a href="login.php">Login</a>
                        <a href="register.php">New Account</a>
                    </div>
                </div> 
                <script>
                    /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
                    function menu_click(){
                        document.getElementById("menu-one").classList.toggle("show");
                    }
                </script>         
            </div>

            <div id="box-two">
					Please log in to account<br><br>
   					<form action="login.php" method="POST">
                		User Name<br><input class="input-box" type="text" name="uid" placeholder="User Name"><br><br>
           				Password<br><input class="input-box" type="password" name="pwd" placeholder="Password"><br><br>
           				<br><button type="submit" class="main-button">Log In</button>
   					</form><br>
					<?php
                        /* Start session to access $_SESSION global array */
                        session_start();

                        if( $_SESSION['logged_in'] == null ){
                            require 'db.php'; 
                        }
                        else{
                            header("location: profile.php");
                        }
						/* Assign variables from HTML form */
						$user_id = $_POST["uid"];
						$pword = $_POST["pwd"];

						/* Search and print record. mysqli_query returns mysqli object, needing conversion to PHP array with mysqli_fetch_array. */
						$result = mysqli_query($connect, "SELECT * FROM $table WHERE uid = '$user_id'");
						$row = mysqli_fetch_array($result);

						if( $row{'pwd'} != null ){
							
							$_SESSION['id'] = $row{'id'};
							$_SESSION['first'] = $row{'first'};
							$_SESSION['last'] = $row{'last'};
							$_SESSION['uid'] = $row{'uid'};
							$_SESSION['password'] = $row{'pwd'};
							$_SESSION['logged_in'] = true;
							
                            header("location: profile.php");
						}
						else{
                            if( $row{'pwd'} != $pword ){
    							echo "login.php: Error: password incorrect"."<br>";
                            }
						}
      				?>	
			</div>	

        </div> <!-- End main -->

        <div id="footer">
            <h3>Techbook | Welcome &copy;2017</h3>
        </div>

    </div> <!-- End container -->

</body>
</html>



