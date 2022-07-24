<?php
require "../private/autoload.php";

    $Error = '';
    $email = '';
   if($_SERVER['REQUEST_METHOD'] == "POST"){
     $email = $_POST['email'];
     if ( !preg_match("/^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/", $email) ) {
       $Error = "Please enter a valid email or password";
     }
     $password = escp($_POST['password']);//my function, can get rid of escp because of prepare statement usage
     
     if ($Error == "") {
            $arr['password'] = $password;
            $arr['email'] = $email;
            $query = "select * from users where email = :email && password = :password limit 1";
           //echo $query;
           //mysqli_query($connection, $query);
            $statement = $connection->prepare($query);
            $check =  $statement->execute($arr);
            if ($check) {
                $data = $statement->fetchAll(PDO::FETCH_OBJ);
                if(is_array($data) && count($data) > 0){
                    $data = $data[0];
                    $_SESSION['url_address'] = $data->url_address;
                    $_SESSION['username'] = $data->username;
                    header("Location: index.php");
                    die;
                }
            }
     }
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
        <div id="signup-title">Login</div>
        <input id="textbox" type="email" name="email" value="<?php echo $email ?>" placeholder="email" required><br>
        <input id="textbox" type="password" name="password" placeholder="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>