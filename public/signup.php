<?php
require "../private/autoload.php";

    $Error = '';
   if($_SERVER['REQUEST_METHOD'] == "POST"){
     //print_r($_POST);
     $email = $_POST['email'];
     if ( !preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email) ) {
       $Error = "Please enter a valid email";
     }
     $password = $_POST['password'];
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
        <input id="textbox" type="email" name="email" required><br>
        <input id="textbox" type="password" name="password" required><br><br>
        <input type="submit" value="Signup">
    </form>
</body>
</html>