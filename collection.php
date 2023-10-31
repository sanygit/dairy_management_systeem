<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Daily Milk Collection</title>
         <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
         </style>
        <script type="text/javascript">
            document.getElementById('date').value = Date();
        </script>
    </head>
    <body class="a">
        <h3><a href="index.php">HOME</a></h3>
        <?php
        $mysql = mysqli_connect("localhost", "root", "");
        mysqli_select_db($mysql, "dairy");
        ?>

        <h1 align="center">DAILY MILK COLLECTION</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <table border="1" cellspacing="5" cellpadding="5" align="center">
                <tr align="center"><th>DATE</th><th>TIME</th><th>CUSTOMER ID</th><th>QTY/LTR</th><th>FAT</th></tr>
                <tr align="center">
                    <td><input type="text" name="date" id="date"/></td>
                    <td><select name="time" id="time"><option>Morning</option><option>Evening</option></select></td>
                    <td><select name="ssn" id="ssn">
                        <?php
                        $result1 = mysqli_query($mysql, "SELECT * FROM customer");
                        while ($row = mysqli_fetch_assoc($result1)) {
                            print "<option>" . $row["ssn"] . "</option>";
                        }
                        mysqli_free_result($result1);
                        ?>
                        </select>
                    </td>
                    <td><input type="text" name="qty" id="qty"/></td>
                    <td><input type="text" name="fat" id="fat"/></td>
                </tr>
                <tr align="center"> <td colspan="5"><input style="background-color: orange" type="submit" value="Insert" size="5"/><input style="background-color: orange" type="reset" value="Cancel" size="5"/></td></tr>
            </table>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $date = $_POST["date"];
            $time = $_POST["time"];
            $ssn = $_POST["ssn"];
            $qty = $_POST["qty"];
            $fat = $_POST["fat"];
            $total = 66;

            $result2 = mysqli_query($mysql, "SELECT * FROM customer WHERE ssn = $ssn");
            while ($array = mysqli_fetch_row($result2)) {
                $type = $array[3];
            }
            mysqli_free_result($result2);

            if ($type == "Buffalo") {

                $result3 = mysqli_query($mysql, "SELECT * FROM bratechart WHERE bfat='$fat'");
                while ($array = mysqli_fetch_row($result3)) {
                    $rate = $array[1];
                }
                mysqli_free_result($result3);
            } else {
                $result4 = mysqli_query($mysql, "SELECT * FROM cratechart WHERE cfat='$fat'");
                while ($array = mysqli_fetch_row($result4)) {
                    $rate = $array[1];
                }
                mysqli_free_result($result4);
            }

            $total = $qty * $rate;

            if ($date && $time && $ssn && $type && $total) {
                mysqli_query($mysql, "INSERT INTO collection(`date`, `time`, `ssn`, `type`, `qty`, `fat`, `rate`, `total`)VALUES('$date','$time','$ssn','$type','$qty','$fat','$rate','$total')");
            }
        }

        ?>
        <table border="1" cellspacing="5" cellpadding="5" align="center">
            <caption><strong>DAILY-MILK-COLLECTION-DETAILS</strong></caption>
            <tr><th> DATE </th> <th> TIME </th><th>CUSTOMER ID</th><th>MILK TYPE</th><th>QTY/LTR</th><th>FAT</th><th> RATE</th> <th> TOTAL</th></tr>
            <?php
            $result6 = mysqli_query($mysql, "SELECT * FROM collection");
            while ($array = mysqli_fetch_row($result6)) {
                print"<tr align='center'>";
                print"<td> $array[0]</td>";
                print"<td> $array[1]</td>";
                print"<td> $array[2]</td>";
                print"<td> $array[3]</td>";
                print"<td> $array[4]</td>";
                print"<td> $array[5]</td>";
                print"<td> $array[6]</td>";
                print"<td> $array[7]</td>";
                print"</tr>";
            }
            mysqli_free_result($result6);
            mysqli_close($mysql);
            ?>
        </table>
    </body>
</html>
