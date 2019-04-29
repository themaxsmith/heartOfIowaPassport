<?php
session_cache_limiter('none');
session_start();

function generateRandomString($length = 14) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if ($_SESSION['validAdmin'] != "yes")
{
  header('Location: /admin/login');
}
	require("../assets/connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);



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
    $statement = $conn->prepare('INSERT INTO wineries (name, image_url, address, code, owner)
        VALUES (:name, :image_url, :address, :code, :owner)');

    $statement->execute([
        'name' => $_POST["name"],
        'image_url' => $_POST["image_url"],
        'address' => $_POST["address"],
        'owner' => $_SESSION["userID"],
        'code' => generateRandomString()
    ]);
      echo "New record created successfully";
      	header('Location: /admin?message=insert_success');
      }
  catch(PDOException $e)
      {
      echo $sql . "<br>" . $e->getMessage();
      }



}
  $conn = null;
?>
<style>
#event_location{
  display:none;
}
</style>
<form name="form" method="post" action="#">
    Location Name: <input type="text" name="name" id="event_presenter"><br />
    Image URL: <input type="text" name="image_url" id="event_name"><br />
    address: <input type="text" name="address" id="event_name"><br />


    <span id="event_location">Location: <input type="text" name="event_location"></span><br />
    <input type="submit" name="submit" id="submit" value="Submit">

</form>
<a href="/admin">Go Back Home</a>
