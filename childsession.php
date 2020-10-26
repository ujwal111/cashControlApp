<?php 
session_start();
if((!$_SESSION['email'])||$_SESSION==""){
    header("Location:clogin.php");
} 
$childemail = $_SESSION['email'];
require "include/db_connection.php";
require "include/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C3 Child</title>
    <link href="css/beautify-session.css" rel="stylesheet">
    <style>
/*Style for message display*/
 .message{
    text-align:center;
    margin: 20px auto;
    width:100%;
    }

    </style>
</head>

<body>
    <?php require "menulogin.php"?>
    <div class="form">
    <h1>Purchase the products</h1>
    <form action="" method="post">
    <label for="name">Product Name:</label>
        <input type="text" name="product_name" id="name">
        <label for="email">Product Price:</label>
        <input type="text" name="product_price" id="email">
        <input type="submit" name="submit" value="Submit" class="submit">
    </form>
    <?php 
    global $connect;
    $sql = "SELECT * FROM children WHERE child_email = '$childemail'";
    $fetchqueryid = mysqli_query($connect,$sql);
    $rowid = 0;
    if(mysqli_num_rows($fetchqueryid)>0){
        $row = mysqli_fetch_assoc($fetchqueryid);
        $rowid = $row['id'];
        $authorization = $row['money_authorized'];
        $budget = $row['budget'];
        $total = $row['total_amount'];
    }
    if (isset($_POST['submit'])){
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $budget_exceed = false;
        if($product_price > $budget){
            $budget_exceed = true;
        }
        else{
            $budget_exceed = false;
            $total1 = abs($total - $product_price);
            $totalchange = "UPDATE children SET total_amount = '$total1' WHERE id = '$rowid'";
            $totalchangequery = mysqli_query($connect,$totalchange);
        }

        if($authorization == "on" && $budget_exceed == false){
        $sql1 = "INSERT INTO products(product_name,product_price,child_id) VALUES ('$product_name','$product_price','$rowid')";
        $insertquery = mysqli_query($connect,$sql1);
        if($insertquery>0){
            echo "<div class='message'>
                <p>The product was purchased</p>
            </div>";
        }
        else{
            echo "<div class='message'>
            <p>the product could not be purchased because you have low budget or No authorization</p>
            </div>";
            
        }
    }
    else{
        echo "<div class='message'>
            <p>The Authorization is turned off for the account or your budget is too low</p>
            </div>";
    }
    }

?>
    </div>
    <div class="childs-table">
    <h1>Details of the product bought</h1>
        <table>
        <thead>
        <th>Product Name</th>
        <th>Total Amount of product</th>
        <th>Purchase Date</th>
        </thead>
        <tbody>
        <?php 
            $readsql = "SELECT * FROM products WHERE child_id = $rowid";
            $fetchproquery = mysqli_query($connect,$readsql);
            if(mysqli_num_rows($fetchproquery)>0){
                while($row = mysqli_fetch_assoc($fetchproquery)){

               
        ?>
        <tr>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['product_price']; ?></td>
        <td><?php echo $row['purchase_date']; ?></td>
        </tr>
        
        <?php
    }
            }
            ?>
        </tbody>
        </table>
    </div>
    <script src="nav.js">
    </script>
</body>
</html>