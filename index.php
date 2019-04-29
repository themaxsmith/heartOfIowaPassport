<!DOCTYPE html>
<html lang="en">
<head>
   <script src="/cdn-cgi/apps/head/P0U1nNIVNWEO-5MEqCKZL-Uw9Ic.js"></script><link rel="shortcut icon" type='image/x-icon' href="//gametimebroadcast.com/assets/favicon.ico"/>
  <title>Passport</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
    <?php session_start(); require("assets/nav.php");?>

    <div class="container p-4">
    <h1 style="width:100%; text-align:center;">Wineries</h1>

        <div class="row p-3" style="border:none; background:white; height:210px;">

  <?php



  require("assets/connection.php");

  $stmt = $conn->prepare("SELECT * FROM wineries AS w");
  $stmt->execute([$id]);

  if ($stmt->execute()) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>

      <div class="col-3 p-2">
        <img src="<?php echo $row["image_url"]?>" style="height:auto; width:100%;" />
      </div>
      <div class="col-9 p-2">

        <h3><?php echo $row["name"]?></h3>
        <p><?php echo $row["address"]?></p>
  <a target="_blank" href="https://maps.google.com/?q=<?php echo urlencode($row["address"])?>" class="btn btn-dark">Directions</a> <a href="/scan" class="btn btn-dark">Scan QR Code</a>
      </div>


          <?php
      }
  }
  ?>
    </div>
  </div>
</body>
</html>
