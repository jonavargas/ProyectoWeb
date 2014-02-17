<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Student Entry Form</title>
</head>

<body>
	<form action="csvWrite.php" method="post">
		<p>
			Name:<bsr>
			<input type="text" name="formName" maxlength="50"/>
		</p>
		<p>
			Last name 1:<bsr>
			<input type="text" name="formLastName1" maxlength="50" />
		</p>
		<p>
			Last name 2:<bsr>
			<input type="text" name="formLastName2" maxlength="50" />
		</p>
		<p>
			Email:<bsr>
			<input type="text" name="formEmail" maxlength="50"/>
		</p>
		<p>
			Phone:<bsr>
			<input type="text" name="formPhone" maxlength="50" />
		</p>
		<p>
			ID:<bsr>
			<input type="text" name="formID" maxlength="50"/>
		</p>				
		<input type="submit" name="formSubmit" value="Submit" />
	</form>
</body>
</html>

