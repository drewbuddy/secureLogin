<!DOCTYPE html>
<html>
<head>
<title>Secure Login</title>
</head>
<body>
	<form action="login.php" name="login" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="pass" /><br />
		<input type="submit" value="Log in" />
	</form>
	<p>
	Or register a new account:
	</p>
	<form action="reg.php" name="register" method="post">
		Username: <input type="text" name="regName" maxlength="30" /><br />
		Password: <input type="password" name="regPass1" /><br />
		Confirm Password: <input type="password" name="regPass2" /><br />
		<input type="submit" value="Register" />
	</form>
</body>
</html>