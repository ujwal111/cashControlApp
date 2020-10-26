<?php 
$id = $_GET['id'];
require "include/db_connection.php";
require "include/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C3 Child Edit Page</title>
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
        <h1>Editing of child account</h1>
        <?php 
           global $connect;
           $childsql = "SELECT * FROM children WHERE id = '$id'";
           $child_fetch_query = mysqli_query($connect,$childsql);
           if(mysqli_num_rows($child_fetch_query)>0){
               while($rowf = mysqli_fetch_assoc($child_fetch_query)){
            
        ?>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="username" id="name" value=<?php echo $rowf['child_name'];?>>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value=<?php echo $rowf['child_email'];?>>
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" value=<?php echo $rowf['child_password'];?>>
         <?php echo "(The authorization currently is ".  $rowf['money_authorized'].")";?>
        <label for="authorization">Money Authorization</label>
        <select name="authorize" id="authorization">
        <option value="on">ON</option>
        <option value="off">OFF</option>
        </select>
        <?php echo "The total amount present is ".$rowf['total_amount'];?>
        <input type="text" value=<?php echo $rowf['total_amount'];?> name="previous_total" hidden>
        <label for="total">Add Amount:</label>
        <input type="text" name="total" id="total" value=<?php echo $rowf['total_amount'];?>>
        <label for="budget">Child Budget:</label>
        <input type="text" name="budget" id="budget" value=<?php echo $rowf['budget'];?>>
        <input type="submit" name="submit" value="Submit" class="submit">
    </form>

    <?php 
          }
        }
    ?>


<?php 
if(isset($_POST['submit'])){
   update_child_details();
}

?>
    </div>
    <script src="nav.js">
    </script>
</body>
</html>