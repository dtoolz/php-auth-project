<?php
require "../private/autoload.php";
$user_data = check_login($connection); //my function for auth guard

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth App</title>
</head>
<body>
    <h1>Home Page</h1>
    <div>Hi <?php echo $_SESSION['username'] ?></div>
    <div style="float: right;">
       <a href="logout.php">Logout</a>
    </div>
</body>
</html>