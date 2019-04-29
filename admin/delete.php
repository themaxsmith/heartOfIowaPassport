<?php
session_cache_limiter('none');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SESSION['validAdmin'] != "yes")
{
  header('Location: /admin/login');
}
	require("../assets/connection.php");

$stmt = $conn->prepare("DELETE FROM wineries WHERE id = ?");
$stmt->execute(array($_GET["id"]));
$count = $stmt->rowCount();

if ($count==1){
  echo "row effected!";
	header('Location: ../admin?message=delete_success');
}else{
  echo "no row effected!";
	header('Location: ../admin?message=delete_failed');
}
?>
<a href="../admin">Go Back Home</a>
