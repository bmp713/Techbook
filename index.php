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
            <h1>Techbook <span style=" font: 24px sans-serif;">| Advanced </span></h1>
        </div>

        <div id="navbar">
            <a href="index.php">Home</a>
            <a class="current" href="index.php">Login</a></li>
            <a href="register.php">New Account</a>
        </div>

        <div id="main">

            <div id="box-one">
                <div id="menu">
                    <div id="menu-content">
                        <a class="current" href="index.php">Home</a>
                        <a href="index.php">Login</a>
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

                    <h1>Welcome</h1><br>
                    <h2>Please log into sample account or create your own</h2>
                    <p class="login_p">
                        This site was created to demonstrate backend skills with Apache, MySQL, PHP, and responsive design.<br><br>
                        There is no use of any libraries or frameworks.<br>
                    </p><br>
				
   					<form action="index.php" method="POST" id="form_login">
                		User Name<br><input class="input-box" type="text" name="uid" placeholder="User Name" value="steve"><br><br>
           				Password<br><input class="input-box" type="password" name="pwd" placeholder="Password" value="Password"><br><br>
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
    	   				$user_id = $_POST["uid"];
                        $pword = $_POST["pwd"];

                        if( $user_id && $pword ){

    						/* Search and print record. mysqli_query returns mysqli object, needing conversion to PHP array with mysqli_fetch_array. */
                            $result = mysqli_query($connect, "SELECT * FROM $table WHERE uid = '$user_id'");
                            $row = mysqli_fetch_array($result);

    						if( $row['pwd'] != null ){
							
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['first'] = $row['first'];
                                $_SESSION['last'] = $row['last'];
                                $_SESSION['uid'] = $row['uid'];
                                $_SESSION['password'] = $row['pwd'];
                                $_SESSION['logged_in'] = true;
                                header("location: profile.php");
                            }
                            else{
                                if( $row{'pwd'} != $pword ){
                                    echo "index.php: Error: password incorrect"."<br>";
                                }
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



