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
            <?php
                /* render_navbar(); */
                session_start();
                if( $_SESSION['logged_in'] == true ){
                    echo '<a class="current" href="profile.php">Profile</a>';
                    echo '<a href="upload.php">Upload</a>';
                    echo '<a href="delete.php">Delete</a>';
                    echo '<a href="logout.php">Log Out</a>';
                }
                else{
                    echo '<a href="index.html">Home</a>';
                    echo '<a href="index.php">Login</a>';
                    echo '<a href="register.php">New Account</a>';
                }
            ?>
        </div>

        <div id="main">
            
            <div id="box-one">
                <div id="menu">
                    <div id="menu-content">
                        <?php
                            /* render_menu()*/
                            session_start();
                            if( $_SESSION['logged_in'] == true ){
                                echo '<a class="current" href="profile.php">Profile</a>';
                                echo '<a href="upload.php">Upload Files</a>';
                                echo '<a href="delete.php">Delete Account</a>';
                                echo '<a href="logout.php">Log Out</a>';
                            }
                            else{
                                echo '<a href="index.html">Home</a>';
                                echo '<a href="index.php">Login</a>';
                                echo '<a href="register.php">New Account</a>';
                            }
                        ?>
                    </div>
                </div>        
            </div>
            <?php
                /* Render user proile */
                include "render_profile.php";
            ?>
        </div>

        <div id="footer">
            <h3>Techbook | Welcome &copy;2017</h3>
        </div>
    
    </div>

</body>
</html>




