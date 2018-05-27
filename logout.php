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
            <a href="index.html">Home</a>
            <a class="current" href="index.php">Login</a></li>
            <a href="register.php">New Account</a>
        </div>

        <div id="main">
            
            <div id="box-one">
                <div id="menu">
                   	<button onclick="menu_click()" id="menu-button">Menu</button>
                    <div id="menu-content">
                        <a href="index.html">Home</a>
                        <a class="current" href="index.php">Login</a>
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
				<?php
				    session_start();
    				session_unset();
    				session_destroy();
                ?>
                <br><h3>You have been logged out.</h3>
			</div>			

        </div>

        <div id="footer">
            <h3>Techbook | Welcome &copy;2017</h3>
        </div>

    </div> <!-- End container -->

</body>
</html>



