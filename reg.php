<?php
//get POST values
include('functions.php');
error_reporting(E_ALL);
$username = $_POST['regName'];
$pass1 = $_POST['regPass1'];
$pass2 = $_POST['regPass2'];

//If the passwords are mismatched or too long, return to the reg page
if ($pass1 != $pass2) {
	header('Location: loginRegister.php');
}
if (strlen($username) > 30) {
	header('Location: loginRegister.php');
}

//Time to turn that password into a big jumbly mess!

//Initial hash. Uses sha256 for now.  Will change this to sha512
$hash = hash('sha256', $pass1);

//Returns a random 3 char salt
function makeSalt () {
    $randString = md5(uniqid(rand(), true));
    return substr($randString, 0, 3);
}
$salt = makeSalt();
$hash = hash('sha256', $salt . $hash);

//set up database connection, and write new values
//in an ideal situation, these variables would be defined in a config file somewhere else on the server, where someone with FTP or similar access wouldn't be able to stumble on them.

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $conn);
//sanitize username
$username = mysql_real_escape_string($username);
$query = "INSERT INTO users ( username, password, salt )
        VALUES ( '$username' , '$hash' , '$salt' );";
mysql_query($query);
mysql_close();
header('Location: index.php');
?>