<?php
require "../private/autoload.php";

    $Error = '';
    $email = '';
    $username = '';
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

     //check if email exists
     $arr = false;
     $arr['email'] = $email;
     $query = "select * from users where email = :email limit 1";
            $statement = $connection->prepare($query);
            $check =  $statement->execute($arr);
            if ($check) {
                $data = $statement->fetchAll(PDO::FETCH_OBJ);
                if(is_array($data) && count($data) > 0){
                    $Error = "email address has already been used";
                }
            }
     
     if ($Error == "") {
            $arr['url_address'] = $url_address;
            $arr['username'] = $username;
            $arr['password'] = $password;
            $arr['email'] = $email;
            $arr['date'] = $date;
           //$query = "insert into users (url_address,username,password,email,date) values ('$url_address','$username','$password','$email','$date')";
            $query = "insert into users (url_address,username,password,email,date) values (:url_address,:username,:password,:email,:date)";
           //echo $query;
           //mysqli_query($connection, $query);
            $statement = $connection->prepare($query);
            $statement->execute($arr);
            header("Location: login.php");
            die;
     }

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
        <input id="textbox" type="text" name="username" value="<?php echo $username ?>" placeholder="username" required><br>
        <input id="textbox" type="email" name="email" value="<?php echo $email ?>" placeholder="email" required><br>
        <input id="textbox" type="password" name="password" placeholder="password" required><br><br>
        <input type="submit" value="Signup">
    </form>
</body>
</html>