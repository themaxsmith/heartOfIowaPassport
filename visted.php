<!DOCTYPE html>
<html lang="en">
<head>
   <script src="/cdn-cgi/apps/head/P0U1nNIVNWEO-5MEqCKZL-Uw9Ic.js"></script><link rel="shortcut icon" type='image/x-icon' href="//gametimebroadcast.com/assets/favicon.ico"/>
  <title>myLiveGame</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
require("assets/connection.php");


if (isset($_GET["l"])){
$id=$_GET["l"];
$stmt = $conn->prepare("SELECT * FROM wineries WHERE code=?");
$stmt->execute([$id]);
$wine = $stmt->fetch();

if ($wine){

  $_SESSION["scan"] = $wine["id"];
  header("Location: https://passport.mclmediagroup.com/visted");
die();

}else{
  echo "please re-try with the scan";
  die();
}
}else{

if (isset($_SESSION["scan"])){

  if (isset($_SESSION["validUser"])){


    $stmt = $conn->prepare("SELECT * FROM transactions WHERE winery=? AND user=?");
    $stmt->execute([$_SESSION["scan"],$_SESSION["userID"]]);
    $transactions = $stmt->fetch();

    if (!$transactions){

    $stmt = $conn->prepare("INSERT INTO transactions (winery, user) VALUES (?,?)");
    $stmt->execute(array($_SESSION["scan"],$_SESSION["userID"]));
    $count = $stmt->rowCount();

    if ($count==1){
      header("Location: https://passport.mclmediagroup.com/profile?success=".urlencode("You have added the location to your stamps"));
      echo "row effected!";
    }else{
      header("Location: https://passport.mclmediagroup.com/profile");
      echo "no row effected!";
    }
}else{
        header("Location: https://passport.mclmediagroup.com/profile?fail=".urlencode("You have already added the location to your stamps"));
  echo "you have already scaned!";
}

  }else{

header("Location: https://passport.mclmediagroup.com/login?return=visted");

  }



}else{
    header("Location: https://passport.mclmediagroup.com/profile");
  echo "please re-try with the scan";

  die();
}

}
?>
</body>
</html>
