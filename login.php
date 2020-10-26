<?php 
require "include/db_connection.php";
require "include/functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C3 Login Page| Parents</title>
    <link href="css/beautify.css" rel="stylesheet">
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
    <?php require "menu.php"?>
    <div class="form">
    <h1>Login for Parents</h1>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
        <input type="submit" name="submit" value="Submit" class="submit">
    </form>
    </div>
    <?php 
        if (isset($_POST['submit'])){
            parent_login();
        }
        ?>
       
    <script src="nav.js">
    </script>
</body>
</html>