<?php 
    function myFunction($myParam = 'Michael') {
        echo $myParam . ' is pogi';
    }

    myFunction('Makel');
?>

<!DOCTYPE html>
<html>
    <body>
        <form action="welcome.php" method="get">
            Name: <input type="text" name="name">
            Age: <input type="num" name="num">
            Gender: <input type="text" name="gender">
            Birthdate: <input type="text" name="b-date">
            Contact Number: <input type="num" name="contact-no">
            Address: <input type="text" name="address">
            <input type="submit" value="Submit">
        </form>
    </body>
</html>

<!DOCTYPE html>
<html>
    <body>
        <table>
            <?php
                foreach($_GET as $key => $value) {
                echo "
                    <tr>
                        <td>
                            $key    
                        </td>
                        <td>
                            $value
                        </td>
                    </tr>
                ";
                }
            ?>
        </table>
    </body>
</html>

