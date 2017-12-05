<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="LAMP | Server">
    <title> Techbook | Advanced</title>
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
            <?php
                session_start();
                if( $_SESSION['logged_in'] == true ){
                    echo '<a class="current" href="profile.php">Profile</a>';
                    echo '<a href="upload.php">Upload</a>';
                    echo '<a href="delete.php">Delete</a>';
                    echo '<a href="logout.php">Log Out</a>';
                }
                else{
                    echo '<a href="index.html">Home</a>';
                    echo '<a href="login.php">Login</a>';
                    echo '<a href="register.php">New Account</a>';
                }
            ?>
        </div>

        <div id="main">
            
            <div id="box-one">
                <div id="menu">
                    <button onclick="menu_click()" id="menu-button">Menu</button>
                    <div id="menu-content">
                        <?php
                            session_start();
                            if( $_SESSION['logged_in'] == true ){
                                echo '<a class="current" href="profile.php">Profile</a>';
                                echo '<a href="upload.php">Upload Files</a>';
                                echo '<a href="delete.php">Delete Account</a>';
                                echo '<a href="logout.php">Log Out</a>';
                            }
                            else{
                                echo '<a href="index.html">Home</a>';
                                echo '<a href="login.php">Login</a>';
                                echo '<a href="register.php">New Account</a>';
                            }
                        ?>
                    </div>
                </div>        
            </div>
            
            <div id="box-two">
				<?php
                    session_start();
                    require 'db.php';   

                    if( $_SESSION['logged_in'] == true ){

                        $user_dir = "assets/uploads/".$_SESSION['uid'];
                        $user_files = scandir( $user_dir );
                        $number_files = ( count( $user_files ) ) - 3;
                        $user_id = $_SESSION['uid'];

                        // Query user and user background image path
                        $result = mysqli_query( $connect, "SELECT * FROM $table WHERE uid='$user_id';" )
                                or die("<br>ERROR: upload.php: Could not select database $table<br>");
                        $row = mysqli_fetch_array( $result );

                        //Display background image if defined
                        if( isset( $row{'background'} ) ){
                            
                            $target_file = $row{'background'};
                            echo '<script>makeBackground("'.$target_file.'");</script>';
                        }
        
                        // Change background image
                        if( isset( $_GET['make_background']) ){
                        
                            //$target_file = $_GET['target_file'];
                            $_SESSION['background'] = $_GET['target_file'];
                            $target_file = $_SESSION['background'];

                            $result = mysqli_query( $connect, "UPDATE $table SET background='$target_file' WHERE uid='$user_id';" )
                                    or die("<br>ERROR: upload.php: Could not set background $table<br>");
                            
                            $_GET['make_background'] = 0;

                            echo '<script>makeBackground("'.$target_file.'");</script>';
                            //echo 'Background File: '.$target_file.'<br><br><br><br><br>';
                            //echo 'SESSION[background] = '.$target_file.'<br>';
                        }

                        // Change user's main image
                        if( isset( $_GET['make_profile']) ){

                            $_SESSION['user_image'] = $_GET['target_file'];
                            $target_file = $_SESSION['user_image'];

                            $result = mysqli_query( $connect, "UPDATE $table SET image='$target_file' WHERE uid='$user_id';" );

                            echo '<img src="'.$_SESSION['user_image'].'">';
                            
                            $_GET['make_profile'] = 0;
                            //$_GET['target_file'] = 0;

                            //header("location: profile.php");
                        }
                        else{
                            $result = mysqli_query( $connect, "SELECT * FROM $table WHERE uid='$user_id';" );
                            $row = mysqli_fetch_array( $result );

                            $_SESSION['user_image'] = $row{'image'};
                            echo '<img src="'.$_SESSION['user_image'].'">';
                        }
                        //echo '<br>File: '.$row{'image'};
	                    //echo "<br>SESSION[user_image] = ".$_SESSION['user_image'];
	                  	//echo "<br>user_files{2} = ".$user_files{2};
	                  	//echo "<br>user_files{3} = ".$user_files{3};

                        echo "<br><br>__________________________________________________________<br>";  
                        echo '<h1 style="color: white;font-size:36px;">Profile</h1>';     

                        echo '<br><br><h2>Welcome, '.$_SESSION['first']." ".$_SESSION['last'].'</h2>';
                        $user_dir = "assets/uploads/".$_SESSION['uid'];
                        echo "User Directory: ".$user_dir;

                        echo '<br>File Count: '.$number_files."<br><br>";
                        echo '<div class="info"'."<br>ID: ".$_SESSION['id']."</div>";
                        echo '<div class="info"'."<br>First: ".$_SESSION['first']."</div>";
                        echo '<div class="info"'."<br>Last: ".$_SESSION['last']."</div>";
                        echo '<div class="info"'."<br>UserID: ".$_SESSION['uid']."</div>";
                        echo '<div class="info"'."<br>Password: ".$_SESSION['password']."</div><br>";                        
                    }
                    else{
                        header("location: login.php");
                    }
      			?>
			</div>

            <div id="box-three">

                <?php  
                    $user_dir = "assets/uploads/".$_SESSION['uid'];
                    $user_files = scandir( $user_dir );
                    $number_files = count( $user_files );
                    $user_id = $_SESSION['uid'];

                    // Display images in same div 
                    echo '<div class="gallery">';
                    echo '<h1 style="color: rgba(150, 150, 150, 1);font-size:36px;">Gallery</h1><br>'; 

                    // Buttons to change order of gallery images 
                    echo '<a href="profile.php?ascending=true&target_file='.$target_file.'" style="width=50px">Ascending</a> ';
                    echo '<a href="profile.php?descending=true&target_file='.$target_file.'" style="width=50px">Descending</a><br><br><br>';

                    // Delete user image
                    if( isset( $_GET['delete_file']) ){

                      	$user_dir = "assets/uploads/".$_SESSION['uid'];
                       	$user_files = scandir( $user_dir );

                       	// Deleted image same as last image
                       	$last = $user_dir."/".$user_files{2};

                       	if( $_GET['target_file'] == $last ){

                       		// Deleted image same as profile image
                       		if( $_GET['target_file'] == $_SESSION['user_image'] ){
	                            $target_file = $user_dir."/".$user_files{3};
		                        $_SESSION['user_image']= $target_file;
                       		}
                       		else{
                       			$target_file = $_SESSION['user_image'];
                       		}
						}
						else{
                       		// Deleted image same as profile image
                       		if( $_GET['target_file'] == $_SESSION['user_image'] ){
		                        $target_file = $user_dir."/".$user_files{2};
		                       	$_SESSION['user_image']= $target_file;
                       		}
                       		else{
                       			$target_file = $_SESSION['user_image'];
                       		}
						}
                        // Update user inmage in database
						$result = mysqli_query( $connect, "UPDATE $table SET image='$target_file' WHERE uid='$user_id';" )
                                or die("<br>ERROR: upload.php: Could not insert data into $table<br>");

                        // Delete requested file
                        unlink( $_GET['target_file'] );
                        $_GET['delete_file'] = 0;

                        header("location: profile.php");
                    }

                    // Set to display images in descending order
                    if( isset( $_GET['descending']) ){
                        $_SESSION['order'] = 'descending';
                    }
                    else{
                        $_SESSION['order'] = 'ascending';
                    }

                    // Display all user images
                    if( $_SESSION['user_image'] ){

                        if( $_SESSION['order'] == 'descending' ){
                            rsort( $user_files );
                        }
                        // iSet i = 2 to skip over "." ".."
                        for( $i = 2; $i < $number_files; $i++ ){

                            $target_file = 'assets/uploads/'.$_SESSION['uid'].'/'.$user_files{$i};
                            echo '<img src="'.$target_file.'"><br>';
                            echo 'File: '.$target_file.'<br><br>';

                            // Buttons to change main profile image 
                            echo '<a href="profile.php?make_profile=true&target_file='.$target_file.'">Make Profile</a> ';
                            echo '<a href="profile.php?make_background=true&target_file='.$target_file.'">Set Background</a> ';
                            echo '<a href="profile.php?delete_file=true&target_file='.$target_file.'">Delete</a><br><br><br><br><br><br>';
                        } 
                    }
                    echo '</div><br><br>';
                ?>  

            </div>

        <div id="footer">
            <h1>Techbook</h1><br>
                <p>
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.<br>
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.<br>
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.<br>
                <br><br>
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.               
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.<br>
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.<br>
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.               
                This is some random content to demonstrate parallax. This is some random content to demonstrate parallax.<br>
                </p><br><br><br>
        </div>

    </div>
</body>
</html>


<script>
/*function menu_click(){
    document.getElementById("menu-one").classList.toggle("show");
}
//window.addEventListener("scroll", parallax);
function parallax(){
    document.getElementById("header").style.top = ( window.pageYOffset ) + 'px';

    document.getElementById("header").style.width = ( document.getElementById("header").clientWidth - 5 ) + 'px';
    document.getElementById("header").style.height = ( document.getElementById("header").clientHeight + 1 ) + 'px';
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
            //document.getElementById("box-two").style.position = 'fixed';
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
            document.getElementById("navbar").style.position = 'relative';
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
*/
</script> 



