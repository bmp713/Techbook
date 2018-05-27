<?php
echo '<div id="box-two">';

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
        if( isset( $row['background'] ) ){
            $target_file = $row['background'];
            echo '<script>makeBackground("'.$target_file.'");</script>';
        }
        // Change background image
        if( isset( $_GET['make_background']) ){

            $_SESSION['background'] = $_GET['target_file'];
            $target_file = $_SESSION['background'];

            $result = mysqli_query( $connect, "UPDATE $table SET background='$target_file' WHERE uid='$user_id';" )
                or die("<br>ERROR: upload.php: Could not set background $table<br>");
                            
                $_GET['make_background'] = 0;
                echo '<script>makeBackground("'.$target_file.'");</script>';
        }
        // Change user's main image
        if( isset( $_GET['make_profile']) ){
            $_SESSION['user_image'] = $_GET['target_file'];
            $target_file = $_SESSION['user_image'];

            $result = mysqli_query( $connect, "UPDATE $table SET image='$target_file' WHERE uid='$user_id';" );

            echo '<img src="'.$_SESSION['user_image'].'">';
                            
            $_GET['make_profile'] = 0;
        }
        else{
            $result = mysqli_query( $connect, "SELECT * FROM $table WHERE uid='$user_id';" );
            $row = mysqli_fetch_array( $result );

            $_SESSION['user_image'] = $row{'image'};
            echo '<img src="'.$_SESSION['user_image'].'">';
        }                        
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
        header("location: index.php");
    }
echo '</div>'; // End box-two
                    

echo '<div id="box-three">';

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
            $first = $user_dir."/".$user_files{2};

            if( $_GET['target_file'] == $first ){

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
                or die("<br>ERROR: profile.php: Could not insert data into $table<br>");

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
            // Set i = 2 to skip over "." ".."
            for( $i = 2; $i < $number_files; $i++ ){

                $target_file = 'assets/uploads/'.$_SESSION['uid'].'/'.$user_files{$i};
                echo '<img src="'.$target_file.'"><br><br>';

                // Buttons to change main profile image 
                echo '<a href="profile.php?make_profile=true&target_file='.$target_file.'">Make Profile</a> ';
                echo '<a href="profile.php?make_background=true&target_file='.$target_file.'">Set Background</a> ';
                echo '<a href="profile.php?delete_file=true&target_file='.$target_file.'">Delete</a><br><br><br><br><br><br>';
            } 
        }
    echo '</div><br><br>'; // End gallery

echo '</div>'; // End box-three 
?>  



