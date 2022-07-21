<?php
require "../private/autoload.php";

    $Error = '';
   if($_SERVER['REQUEST_METHOD'] == "POST"){
     //print_r($_POST);
     $email = $_POST['email'];
     if ( !preg_match("/^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/", $email) ) {
       $Error = "Please enter a valid email";
     }
     $date = date("Y-m-d H:i:s");
     $url_address = get_random_string(60);//my functions
     $username = trim($_POST['username']);
     if ( !preg_match("/^[a-zA-Z]+$/", $username) ) {
        $Error = "Please enter a valid username";
      }
     $username = escp($_POST['username']);
     $password = escp($_POST['password']);//my function

     $query = "insert into users (url_address,username,password,email,date) values ('$url_address','$username','$password','$email','$date')";
     //echo $query;
     mysqli_query($connection, $query);
     header("Location: login.php");
     die;
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body style="font-family: verdana;">
    <style type="text/css" >
        form{
            margin: auto;
            border: solid thin #aaa;
            padding: 6px;
            max-width: 600px;
        }
        
        #signup-title{
            background-color: #ade3ee;
            padding: 1em;
            text-align: center;
            color: #ffffff;
        }

        #textbox{
            border: solid thin #aaa;
            margin-top: 6px;
            width: 98%;
        }

    </style>
    <form method="post">
        <div>
            <?php 
              if (isset($Error) && $Error != "") {
                echo $Error;
              }
            ?>
        </div>
        <div id="signup-title">Sign Up</div>
        <input id="textbox" type="text" name="username" placeholder="username" required><br>
        <input id="textbox" type="email" name="email" placeholder="email" required><br>
        <input id="textbox" type="password" name="password" placeholder="password" required><br><br>
        <input type="submit" value="Signup">
    </form>
</body>
</html>