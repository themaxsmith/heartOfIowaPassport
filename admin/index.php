<?php session_start(); if (!isset($_SESSION["validAdmin"])){ header("Location: /admin/login"); }?>
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
  <?php  require("../assets/nav.php");?>
  <div class="container p-4"><?php if (isset($_GET["message"])){
  echo "<br /><b style='color:blue;'>".$_GET["message"]."</b>";
}?>
  <h1 style="width:100%; text-align:center;">Your Locations</h1>
  <p style="width:100%; text-align:center; clear:both;">
  <a  href="add" class="btn btn-secondary">Add Location</a></p>
<?php if (isset($_GET["success"])){?>
  <div class="alert alert-success" role="alert">
  <?php echo $_GET["success"];?>
</div>
<?php }?>
<?php if (isset($_GET["fail"])){?>
  <div class="alert alert-danger" role="alert">
  <?php echo $_GET["fail"];?>
</div>
<?php }?>
      <div class="row p-3" style="border:none; background:white; height:210px;">

<?php



require("../assets/connection.php");

$id=$_SESSION["userID"];
$stmt = $conn->prepare("SELECT *, w.id AS idW FROM wineries AS w INNER JOIN admin AS t ON w.owner = t.id AND t.id = ?");
$stmt->execute([$id]);

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>

		<div class="col-3 p-2">
			<img src="<?php echo $row["image_url"]?>" style="height:auto; width:100%;" />
		</div>
		<div class="col-9 p-2">

			<h3><?php echo $row["name"]?></h3>
      <p><?php echo $row["address"]?><br /></p>
<a href="edit?id=<?php echo urlencode($row["idW"])?>" class="btn btn-dark">Edit property</a> <a href="../generate?id=<?php echo urlencode($row["idW"])?>" class="btn btn-dark">Generate QR</a> <a target="_blank" href="delete?id=<?php echo urlencode($row["idW"])?>" class="btn btn-danger">Delete property</a>
		</div>


        <?php
    }
}
?>
	</div>
  <br />
  <br style="width:100%; clear:both;" />

</div>

</body>
</html>
