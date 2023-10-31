<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>All Customer Information</title>
         <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
         </style>
    </head>
    <?php
    $mysql = mysqli_connect("localhost", "root", "");
    mysqli_select_db($mysql, "dairy");
    $sql = 'SELECT * FROM customer';
    ?>
    <body class="a">
        <h3><a href="index.php">HOME</a></h3>
        <table border="1" cellspacing="5" cellpadding="5" align="center">
            <caption><strong>DAIRY-CUSTOMER-DETAILS</strong></caption>
            <tr align="center"><th>CUSTOMER ID</th><th>CUSTOMER NAME</th><th>ADDRESS</th><th>MILK TYPE</th></tr>
            <?php
            $result1 = mysqli_query($mysql, $sql);
            while ($array = mysqli_fetch_row($result1)) {
                print"<tr align='center'>";
                print"<td> $array[0]</td>";
                print"<td> $array[1]</td>";
                print"<td> $array[2]</td>";
                print"<td> $array[3]</td>";
                print"</tr>";
            }
            mysqli_free_result($result1);
            ?>
        </table>
    </body>
</html>
