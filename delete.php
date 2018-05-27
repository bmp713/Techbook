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
            <h1>Techbook <span style=" font: 24px sans-serif;">| Advanced Systems</span></h1>
        </div>

        <div id="navbar">
            <?php
                session_start();
                if( $_SESSION['logged_in'] == true ){
                    echo '<a href="profile.php">Profile</a>';
                    echo '<a href="upload.php">Upload</a>';
                    echo '<a class="current" href="delete.php">Delete</a>';
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
                            session_start();
                            if( $_SESSION['logged_in'] == true ){
                                echo '<a href="profile.php">Profile</a>';
                                echo '<a href="upload.php">Upload Files</a>';
                                echo '<a class="current" href="delete.php">Delete Account</a>';
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

            <div id="box-two">

                    Verify account to delete<br><br>
                    <form action="delete.php" method="POST">
                        User Name<br><input class="input-box" type="text" name="uid" placeholder="User Name"><br><br>
                        Password<br><input class="input-box" type="password" name="pwd" placeholder="Password"><br><br>
                        <br><button type="submit" class="main-button">Delete</button><br>
                    </form>
                    <?php
                        if( isset($_POST["submit"]) ){

                            require 'db.php';   
                            session_start();

                            /* Assign variables from HTML form */
                            $userid = $_POST["uid"];
                            $pword = $_POST["pwd"];

                            /* Connection to mySQL */
                            $connect = mysqli_connect($host, $username, $password, $database)
                                or die("Unable to connect to MySQL");

                            /* Search and print record */
                            $result = mysqli_query($connect, "SELECT * FROM $table WHERE uid = '$userid'");
                            $row = mysqli_fetch_array($result);

                            if( $pword == $row['pwd'] && $pword != null ){    
                                /* Delete record */
                                $query = "DELETE FROM users WHERE uid='$userid'";
                                $result = mysqli_query($connect, $query);

                                if( $_SESSION['first'] ){
                                    if( $result ){
                                        session_unset();
                                        session_destroy();
                                        echo "Account ".$userid." deleted"."<br>";
                                    }
                                    else{
                                        echo "Error: could not delete account \"".$userid."\""."<br>";
                                    } 
                                }   
                            }
                            else{
                                echo "Error: password incorrect"."<br>";
                            }
                        }
                    ?>
            </div>
                    
        </div> <!-- End  main -->

        <div id="footer">
            <h3>Techbook | Welcome &copy;2017</h3>
        </div>

    </div>

</body>
</html>



