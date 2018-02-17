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
            <video src="assets/video/Buildings.mp4" width="100%" autoplay loop muted>
            </video>
        </div>

        <div id="header">
            <h1>Techbook <span style=" font: 24px sans-serif;">| Advanced Systems</span></h1>
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
                    echo '<a href="login.php">Login</a>';
                    echo '<a href="register.php">New Account</a>';
                }
            ?>
        </div>

        <div id="box-one">
            <div id="menu">
                <button onclick="menu_click()" id="menu-button">Menu</button>
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
                            echo '<a href="login.php">Login</a>';
                            echo '<a href="register.php">New Account</a>';
                       }
                        ?>
                </div>
            </div>
        </div>

        <div id="main">

            <div id="box-two">
					Please create new account<br><br>
    	            <form action="register.php" method="POST">
        	            First Name<br><input class="input-box" type="text" name="first" placeholder="First Name"><br><br>
            	        Last Name<br><input class="input-box" type="text" name="last" placeholder="Last Name"><br><br>
                	    User ID<br><input class="input-box" type="text" name="uid" placeholder="User Name"><br><br>
                    	Password<br><input class="input-box" type="password" name="pwd" placeholder="Password"><br><br>
                    	<br><button type="submit" class="main-button">Create</button><br>
                	</form><br>
                	<?php
                        /* Start session to access $_SESSION global array */
                        session_start();

                        /* db.php resets connection and loses session information */
                        if( $_SESSION['logged_in'] == null ){
                            require 'db.php';   
                            

    						/* Assign variables from HTML form */
	   	   	       			$first_name = $_POST["first"];
		      				$last_name = $_POST["last"];
					       	$user_id = $_POST["uid"];
						    $pword = $_POST["pwd"];

				    		/* Print the sql command executed */
					   	    //$query = "INSERT INTO $table VALUES (0, '$first_name', '$last_name', '$user_id', '$pword');";

    						/* Insert new user into database */
	       					$result = mysqli_query($connect, "INSERT INTO $table (first, last, uid, pwd) VALUES ('$first_name', '$last_name', '$user_id', '$pword');")
			     				or die("<br>Could not insert data into $table<br>");

				    		/* Search and print record */
					       	$result = mysqli_query($connect, "SELECT * FROM $table WHERE uid='$user_id'");
						    $row = mysqli_fetch_array($result);

    						if( $pword == $row{'pwd'} ){
	       						/* Assign PHP session variables */
			 				    $_SESSION['id'] = $row{'id'};
			 				    $_SESSION['first'] = $row{'first'};
							    $_SESSION['last'] = $row{'last'};
							    $_SESSION['uid'] = $row{'uid'};
							    $_SESSION['password'] = $row{'pwd'};

      						    /* Print CSS formatted user session information */
      						    if( $_SESSION['first'] ){
								    echo '<div class="info"'."<br>ID: ".$_SESSION['id']."</div>";
								    echo '<div class="info"'."<br>First: ".$_SESSION['first']."</div>";
								    echo '<div class="info"'."<br>Last: ".$_SESSION['last']."</div>";
								    echo '<div class="info"'."<br>UserID: ".$_SESSION['uid']."</div>";
								    echo '<div class="info"'."<br>Password: ".$_SESSION['password']."</div>";
							    }
						    }
						    else{
							    echo "Error: password incorrect"."<br>";
						    }
                        }
                        
					?>
            </div>

            <div id="box-three">
<!--
                <div class="container">         
                    <div class="gallery">
                        <h3>Server 1<h3><br>
                        <a href="./assets/images/servers_4.jpg"><img src="assets/images/servers_6.jpg" width="300" height="200"></a>
                        
                    </div><br><br>
                    <div class="gallery">
                        <h3>Server 2</h3><br>
                        <a href="./assets/images/servers_5.jpg"><img src="assets/images/servers_1.jpg" width="300" height="200"></a>
                    </div><br>
                </div>
-->
            </div>
        </div> <!-- End main -->

        <div id="footer">
            <h3>Techbook | Welcome &copy;2017</h3>
        </div>

    </div> <!-- End contrainer -->

</body>
</html>
<script>
function menu_click(){
    document.getElementById("menu-one").classList.toggle("show");
}
//window.addEventListener("scroll", parallax);
function parallax(){
    document.getElementById("header").style.top = ( window.pageYOffset/2 ) + 'px';
    document.getElementById("main").style.top = -( window.pageYOffset/2 ) + 'px';
}
window.addEventListener("scroll", fixNavbar);
function fixNavbar(){
    if( window.pageYOffset > 150 ){

        if ( window.matchMedia("(min-width: 768px)").matches ){
            document.getElementById("header").style.marginBottom = '-40px';

            document.getElementById("navbar").style.top = '0px';
            document.getElementById("navbar").style.position = 'fixed';
            document.getElementById("box-one").style.position = 'fixed';
            document.getElementById("box-one").style.top = '40px';
            document.getElementById("box-two").style.left = '15%';
            document.getElementById("box-three").style.left = '15%';
        }
        else{
            document.getElementById("navbar").style.top = '0px';
            document.getElementById("navbar").style.position = 'fixed';
            document.getElementById("box-two").style.position = 'fixed';
            //document.getElementById("box-one").style.top = '40px';
        }
    }
    else{
        if ( window.matchMedia("(min-width: 768px)").matches ){
            document.getElementById("navbar").style.top = '40px';
            document.getElementById("navbar").style.position = 'relative'
            document.getElementById("box-one").style.position = 'relative';
            document.getElementById("box-one").style.top = '0px';
            document.getElementById("box-two").style.left = '0%';
            document.getElementById("box-three").style.left = '0%';
        }
        else{
            document.getElementById("navbar").style.marginBottom = '-190px';
            document.getElementById("navbar").style.position = 'relative'
            document.getElementById("box-two").style.position = 'relative';
            document.getElementById("box-two").style.marginTop = '0px';
        }
    }
}
function smoothScroll( elementId ){
    var offset = 35; // Might need to make responsive
    var current = window.pageYOffset;
    var destination = document.getElementById( elementId ).offsetTop;

    var timer = setInterval( function(){
        if( current <= destination ){
            current = current + offset;
            window.scrollTo( 0, current );
            if( current >= destination ){
                clearInterval( timer );
                window.scrollTo( 0, destination );
            }
        }
        if( current >= destination ){
            current = current - offset;
            window.scrollTo( 0, current );
            if( current <= destination ){
                clearInterval( timer );
                window.scrollTo( 0, destination );
            }
        }
    }, 1 );
}
function makeBackground( elementId ){
    console.log("makeBackground()");
    console.log( elementId );

    document.getElementById('box-two').style.background = 'url("' + elementId + '") no-repeat fixed';
    document.getElementById('box-two').style.backgroundSize = 'cover';
}
</script> 








