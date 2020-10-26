<?php 
session_start();
if((!$_SESSION['email'])||$_SESSION==""){
    header("Location:login.php");
} 
$parentemail = $_SESSION['email'];
//echo $email;
require "include/db_connection.php";
require "include/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C3 Parents</title>
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
    <h1>Create an account for your child</h1>
    <form action="" method="post">
    <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
        <label for="amount">Amount to be sent:</label>
        <input type="text" name="amount" id="amount">
        <label for="authorization">Money Authorization</label>
        <select name="authorize" id="authorization">
        <option value="on">ON</option>
        <option value="off">OFF</option>
        </select>
        <label for="budget">Child Budget:</label>
        <input type="text" name="budget" id="budget">
        <input type="submit" name="submit" value="Submit" class="submit">
    </form>
    <?php 
    if (isset($_POST['submit'])){
        register_children();
    }

?>
    </div>
    <div class="childs-table">
    <h1>Details of children</h1>
    
        <table>
        <thead>
        <th>Name</th>
        <th>Email Id</th>
        <th>Total Amount present</th>
        <th>Budget set</th>
        <th>Money Authorization</th>
        <th>Edit Account</th>
        </thead>
        <tbody>
        <?php
        fetch_child_data();
        ?>
        </tbody>
        </table>
    </div>
    <div class="childs-table">
    <h1>Details of the product bought by the children</h1>
        <?php 
        $fetchall = "SELECT children.child_name,products.product_name,products.product_price,products.purchase_date FROM children INNER JOIN products ON products.child_id = children.id";
        $allquery = mysqli_query($connect,$fetchall);
        if(mysqli_num_rows($allquery)>0){
                while($row = mysqli_fetch_assoc($allquery)){

         
        ?>
        <table>
        <thead>
        <th>Name</th>
        <th>Product Name</th>
        <th>Total Amount of product</th>
        <th>Products name</th>
        </thead>
        <tbody>
        <tr>
        <td><?php echo $row['child_name'];?></td>
        <td><?php echo $row['product_name'];?></td>
        <td><?php echo $row['product_price'];?></td>
        <td>  
        <?php echo $row['purchase_date'];?>
        </td>
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