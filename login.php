<?php
include('functions.php');
session_start(); //must call session_start before using any $_SESSION variables
$username = $_POST['username'];
$password = $_POST['pass'];

$username= 'admin';
$password = 'password';
//connect to the database here
//$username = mysql_real_escape_string($username);
$dbh = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
$getUser = $dbh->query("SELECT password, salt FROM users WHERE username = '$username';");
var_dump($getUser);

//$conn = mysql_connect($dbhost, $dbuser, $dbpass);
//mysql_select_db($dbname, $conn);
$username = mysql_real_escape_string($username);
$query = "SELECT password, salt
        FROM users
        WHERE username = '$username';";
$result = $dbh->query($query);
if(mysql_num_rows($result) < 1) //no such user exists
{
    header('Location: loginRegister.php');
    die();
}
$userData = mysql_fetch_array($result, MYSQL_ASSOC);
$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
if($hash != $userData['password']) //incorrect password
{
    header('Location: loginRegister.php');
    die();
}
else
{
    validateUser(); //sets the session data for this user
}
header('Location: index.php');
?>