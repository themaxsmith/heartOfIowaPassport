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
require("assets/nav.php");
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_cache_limiter('none');
session_start();

	if (isset($_SESSION['validUser']) && $_SESSION['validUser'] == "yes")
	{

    $username = $_SESSION["userName"];
		$message = "Welcome Back! $username";
	}
	else
	{
		if (isset($_POST['submitLogin']) )
		{
			$inUsername = $_POST['loginUsername'];
			$inPassword = $_POST['loginPassword'];

			require("assets/connection.php");




			$sql = "SELECT * FROM user WHERE email = ? AND password = ?";

    $query = $conn->prepare($sql);
    $query->execute(array($inUsername,md5($inPassword)));
    $row = $query -> fetch();
    $userName = $row["id"];

    if($query->rowCount() == 1) {
				$_SESSION['validUser'] = "yes";
        $_SESSION["userID"] = $userName;
				$message = "Welcome Back! $userName";

			}
			else
			{

				$_SESSION['validUser'] = "no";
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}

			$conn = null;

		}
		else
		{

		}

	}


?>



<h2><?php echo $message?></h2>

<?php
	if ($_SESSION['validUser'] == "yes")
	{
    if (isset($_SESSION["scan"])){
  header("Location: https://passport.mclmediagroup.com/visted");
}else{
	header("Location: https://passport.mclmediagroup.com/profile");
}
	}
	else
	{
?>
<div class="container p-5" style="text-align:center">
                <h1>Login to your account to continue:</h1>
                <form method="post" name="loginForm" action="login.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" class="btn btn-primary" value="Login" type="submit" /></p>
                </form>
							</div>
<?php
	}
?>


</body>
</html>
