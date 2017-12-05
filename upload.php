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
            <h1>Techbook <span style="font: 24px sans-serif;">| Advanced Systems</span></h1>
        </div>

        <div id="navbar">
            <?php
                session_start();
                if( $_SESSION['logged_in'] == true ){
                    echo '<a href="profile.php">Profile</a>';
                    echo '<a class="current" href="upload.php">Upload</a>';
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
                                echo '<a href="profile.php">Profile</a>';
                                echo '<a class="current" href="upload.php">Upload Files</a>';
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

                <form action="upload.php" method="post" enctype="multipart/form-data">
                    Select file to upload:
                    <input type="file" name="file_upload"><br><br>
                    <input type="submit" name="submit" value="Upload File" class="main-button">
                </form>

                <?php
                    if( isset($_POST['submit']) ){

                        session_start();
                        require 'db.php';   

                        $user_id = $_SESSION['uid'];
                        $target_dir = 'assets/uploads/'.$user_id.'/';
                        $target_file = $target_dir.basename( $_FILES['file_upload']['name'] );

                        // File and temporary file names
                        $file_name = $_FILES['file_upload']['name'];     // Name of file uploaded
                        $file_temp = $_FILES['file_upload']['tmp_name']; // Temporary path to temporary named file

                        // Only creates user directory if does not exist.
                        mkdir( $target_dir );
                        echo "<br>User ID: ".$user_id;
                        echo "<br><br>File Name: ".$file_name;
                        echo "<br><br>Temporary File: ".$file_temp;
                        echo "<br>Target Directory: ".$target_dir;
                        echo "<br>Target File: ".'assets/uploads/'.$user_id.'/'.$_FILES['file_upload']['name'];

                        // Check if file already exists in user directory
                        if( file_exists( $file_name ) ){
                            $errors = 1;
                            echo "<br>upload.php: Error: File already exists.";
                        }
                        // Check if there were any errors
                        if( $errors == 0 ){

                            if( move_uploaded_file( $_FILES['file_upload']['tmp_name'], $target_file ) ){

                                echo "<br>File: ".$file_name." has been uploaded.";
                                $_SESSION['user_image'] = 'assets/uploads/'.$_SESSION['uid'].'/'.$file_name;
                                // Set user image in database to uploaded image
                                $result = mysqli_query( $connect, "UPDATE $table SET image='$target_file' WHERE uid='$user_id';" )
                                        or die("<br>ERROR: upload.php: Could not insert data into $table<br>");
                            }
                            else{
                                echo "<br>2 Error: File not uploaded";
                            }      
                        }  
                    }
                ?>
            </div>

        </div>

        <div id="footer">
            <h3>Techbook | Welcome &copy;2017</h3>
        </div>

    </div>
</body>
</html>
