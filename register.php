<?php 

require "include/db_connection.php";
require "include/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C3 Registration Page</title>
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
        <h1>Registration for Parents</h1>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="username" id="name">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
        <input type="submit" name="submit" value="Submit" class="submit">
    </form>
    </div>
    <?php 
    if (isset($_POST['submit'])){
      register_parent();
    }

?>
    <script src="nav.js">
    </script>
</body>
</html>