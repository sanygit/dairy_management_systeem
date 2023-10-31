<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dairy Billing System</title>
        <link href="../css/public.css" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body bgcolor="#FFFF66">
        <div id="header">
            <h1>Dairy Milk Collection & Billing System</h1>
        </div>
        <div id="main">
            <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
            <table id="structure">
                <tr>
                    <td id="navigation">
                        <ul>
                            <li class="last"><a href="customer.php">Add New Customer</a></li><br/>
                            <li class="last"><a href="bratechart.php">Add Buffalo Rate Chart</a></li><br/>
                            <li class="last"><a href="cratechart.php">Add Cow Rate Chart</a></li><br/>
                            <li class="last"><a href="collection.php">Daily Milk Collection</a></li><br/>
                            <li class="last"><a href="getallcustomer.php"> Get All Customer Information</a></li><br/>
                            <li class="last"><a href="allcustomerbill.php"> Get All Customer Bill</a></li><br/>
                            <li class="last"><a href="singlecustomerbill.php"> Get Single Customer Bill</a></li><br/>
                            <li class="last"><a href="login.php"> Logout</a></li><br/>
                        </ul>			
                    </td>
                    <td id="page">
                        <h2>Welcome to Dairy Milk Collection and Billing </h2>
                        <img src="img/22.jpg" alt="" width="100%" height="100%"/> 
                    </td>
                </tr>
            </table>
        </div>
        <div id="footer" title = "Designed & Developed by CRB">Copyright 2019, By SUMAN MALLIKARJUN HUGAR</div>
    </body>
</html>