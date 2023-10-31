<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer</title>
         <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
         </style>
    </head>
    <body class="a">
        <h3><a href="index.php">HOME</a></h3>
        <h1 align="center">Customer</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <table border="1" cellspacing="5" cellpadding="5" align="center">
                <tr><th>Customer No.</th><th>Name</th><th>Address</th><th>Milk Type</th></tr>
                <tr>
                    <td align="center"><input type="text" name="ssn" id="ssn" size="20" maxlength="20" readonly/></td>
                    <td><input type="text" name="name" id="name" size="20"/></td>
                    <td><input type="text" name="address" id="address" size="20"/></td>
                    <td>
                        <select name="mtype">
                            <option>Buffalo</option>
                            <option>Cow</option>
                        </select>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="4">
                        <input style="background-color: orange" type="submit" value="Insert" size="5"/>
                        <input style="background-color: orange" type="reset" value="Cancel" size="5"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Connect to database
            $mysql = mysqli_connect("localhost", "root", ""); // host, user, password
            
            // Select database
            mysqli_select_db($mysql, 'dairy');
            
            // Collect post data
            $ssn = $_POST["ssn"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            $mtype = $_POST["mtype"];
            
            // Insert to database
            if ($ssn && $name && $address) {
                mysqli_query($mysql, "INSERT INTO customer VALUES('$ssn','$name','$address','$mtype')");
            }
            
            // Get next customer No
            $result2 = mysqli_query($mysql, "SELECT * FROM customer ORDER BY ssn DESC");
            $num = mysqli_num_rows($result2);
            
            // Set to customer no input box
            $array = mysqli_fetch_row($result2);
            if ($num == 0) {
                print"<script>document.getElementById('ssn').value=1;</script>";
                print"<script>document.getElementById('name').focus();</script>";
            } else {
                $num = $array[0] + 1;
                print"<script>document.getElementById('ssn').value=$num;</script>";
                print"<script>document.getElementById('name').focus();</script>";
            }
            
            // Free result set
            mysqli_free_result($result2);
            ?>
            <table border="1" cellspacing="5" cellpadding="5" align="center">
                <caption><strong>CUSTOMER-DETAILS</strong></caption>
                <tr><th>Customer No.</th><th>Name</th><th>Address</th><th>Milk Type</th></tr>
            <?php
            $result3 = mysqli_query($mysql, "SELECT * FROM customer ORDER BY ssn DESC");
            while ($array = mysqli_fetch_row($result3)) {
                print"<tr align='center'>";
                print"<td> $array[0]</td>";
                print"<td> $array[1]</td>";
                print"<td> $array[2]</td>";
                print"<td> $array[3]</td>";
                print"</tr>";
            }
            mysqli_free_result($result3);
            mysqli_close($mysql);
        }
        ?>
        </table>
    </body>
</html>
