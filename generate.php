<?php
require("assets/connection.php");

$id=$_GET["id"];
$stmt = $conn->prepare("SELECT * FROM wineries WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($user){
  echo "code: <br />";
  echo "http://passport.mclmediagroup.com/visted?l=".$user["code"]."<br /><br />";
}else{
  echo "winery not found";
  die();
}
?>
<script type="text/javascript" src="assets/qrgen.js"></script>
<div id="qrcode"></div>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	text: "http://passport.mclmediagroup.com/visted?l=<?php echo $user["code"];?>",
	width: 600,
	height: 600,
	colorDark : "#000000",
	colorLight : "#ffffff",
	correctLevel : QRCode.CorrectLevel.H
});
</script>
