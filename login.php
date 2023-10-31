<?php
    // Clear login data
    session_start();
    
    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
    
    // Start session again
    session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>User Login</title>
        <style>
            .a{
                 background-image: url(img/12.jpg);
                 background-size: cover;
            }
            .aa{
                width: 300px;
                margin: auto;
            }
        </style>
    </head>
    <body class="a">  
        <div class="aa">       
            <h1> User Login </h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <p> User name:<br /><input type="text" name="user"/></p>
                <p> Password:<br /><input type="password" name="password"/></p>
                <p> <input style="background-color: orange" type="submit" value="Login"/> <input style="background-color: orange" type="reset" value="Clear"/></p>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["user"];
            $password = $_POST["password"];

            if ($user && $password) {
                
                $mysql = mysqli_connect("localhost", "root", "");
                mysqli_select_db($mysql, "dairy");
                
                $result1 = mysqli_query($mysql, "SELECT * FROM login WHERE user='$user' and password='$password'");
                $count = mysqli_num_rows($result1);
                mysqli_free_result($result1);
                if ($count == 1) {
                    $_SESSION['User'] = $user;
                    header("location:index.php");
                } else {
                    echo "Wrong username or password";
                }
            }
        }
        ?>
    </body>
</html>
