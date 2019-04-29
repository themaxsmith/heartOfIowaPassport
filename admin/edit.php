<?php
ini_set('display_errors', 1);

	session_cache_limiter('none');
	session_start();

  if ($_SESSION['validAdmin'] != "yes")
  {
    header('Location: /admin/login');
  }
  	require("../assets/connection.php");

	error_reporting(E_ALL);


  $vaild = True;
  if (!isset($_POST["name"])){
    $vaild = False;
  }
  if (!isset($_POST["image_url"])){
    $vaild = False;
  }
  if (!isset($_POST["address"])){
    $vaild = False;
  }
	if ($vaild){


	  try {

	    $statement = $conn->prepare('UPDATE wineries  SET name = :name, image_url = :image_url, address = :address WHERE id = :id');

	    $statement->execute([
        'name' => $_POST["name"],
        'image_url' => $_POST["image_url"],
        'address' => $_POST["address"],
	        'id' => $_POST["id"]
	    ]);
	      echo "record updated successfully";
					header('Location: /admin?message=update_success');
	      }
	  catch(PDOException $e)
	      {
	      echo $sql . "<br>" . $e->getMessage();
	      }



	}


  $stmt = $conn->prepare("SELECT * FROM wineries WHERE id=?");
  $stmt->execute(array($_GET["id"]));
  $row = $stmt->fetch();
  	?>
  	<style>
  	#event_location{
  	  display:none;
  	}
  	</style>
  	<form name="form" method="post" action="#">
  	    Location ID: <input type="text" name="id" value="<?php echo $_GET["id"]?>" id="event_id"><br />
  	    Location Name: <input type="text" name="name"  value="<?php echo $row["name"]?>" id="event_presenter"><br />
  	    Address: <input type="text" name="address" value="<?php echo $row["address"]?>" id="event_name"><br />
  	    Image URL: <input type="text" name="image_url" value="<?php echo $row["image_url"]?>" id="event_name"><br />
  	    <span id="event_location">Location: <input type="text" name="event_location"></span><br />
  	    <input type="submit" name="submit" id="submit" value="Submit">

  	</form>
  	<a href="/admin">Go Back Home</a>
