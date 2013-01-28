<?php
include('functions.php');
session_start();
//if the user has not logged in
if(!isLoggedIn())
{
    header('Location: loginRegister.php');
    die();
}
//page content follows
?>
<!DOCTYPE html>
<html>
<head>
<title>Secret Stuff!</title>
</head>
<body>
<p>
You are logged in and can see mah seekrets!
</p>
</body>