<?php
session_start();
if (!isset($_SESSION['User'])){
    header("location:login.php");
}

$mysql = mysqli_connect("localhost", "root", "");
mysqli_select_db($mysql, "dairy");
?>
<!DOCTYPE Html>
<html>
    <head> <title> Print Customer Bill </title>  <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
         </style>
    </head>
    <body class="a">
        <h3><a href="index.php">HOME</a></h3>
    <center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p> Select Customer ID: 
                <select name="ssn" id="ssn"> 
                    <?php
                    $result1 = mysqli_query($mysql, "SELECT * FROM customer");
                    while ($array = mysqli_fetch_row($result1)) {
                        print "<option>" . $array[0] . "</option>";
                    }
                    mysqli_free_result($result1);
                    ?> 
                </select> </p>
            <p> From Date: <input type="text" name="fromdate" id="fromdate"/> </p>
            <p> To Date: <input type="text" name="todate" id="todate"/></p>
            <p> NOTE : Date should be in YYYY-MM-DD format</p>
            <p> <input style="background-color: orange" type="submit" name="submit" value="Generate"/>
            </p>
    </center>
</form>
<center>
    <table border="border" cellspacing="1" cellpadding="1" align="center">
        <tr> <th>SL No</th> <th> CUSTOMER ID</th> <th>CUSTOMER NAME</th> <th>MILK TYPE</th> <th>TOTAL MILK in LTR</th> <th>TOTAL RUPEES</th> 
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $ssn = $_POST["ssn"];
            $fromdate = $_POST["fromdate"];
            $todate = $_POST["todate"];

            echo '<h2 align="center">Bill Payent From ' . $fromdate . ' To ' . $todate . '</h2>';

            if ($ssn && $fromdate && $todate) {
                $presult = mysqli_query($mysql, "SELECT name, ssn, type, SUM(qty), SUM(total) FROM viewbill WHERE ssn = '" . $ssn . "' AND date BETWEEN '" . $fromdate . "' AND '" . $todate . "'");
                $n = 1;
                $grandqty = 0;
                $grandtotal = 0;
            }

            while ($array = mysqli_fetch_row($presult)) {
                print "<tr>";
                print "<td align='center'> $n </td>";
                print "<td align='center'> $array[1] </td>";
                print "<td align='center'> $array[0] </td>";
                print "<td align='center'> $array[2] </td>";
                print "<td align='center'> $array[3] </td>";
                print "<td align='center'> $array[4] </td>";
                print "</tr>";

                $n = $n + 1;
                $grandtotal = $grandtotal + $array[4];
            }
            mysqli_free_result($presult);
            mysqli_close($mysql);
        }
        ?>
        <tr> <td colspan="5" align="right"> Grand Total Rupees </td> <td align="center"> <?php echo("$grandtotal") ?> </tr>
    </table>
    <br/>
    <!-- <center> <a href="javascript:window.print()" title="Print"> <b> Print </b> </a></center> -->
</body>
</html>