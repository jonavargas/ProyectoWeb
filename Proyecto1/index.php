<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Registration</title>
	<meta name="viewport" content="width=width-device, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/lib/jquery-1.11.0.js"></script>
	<script type="text/javascript"> scr="js/lib/bootstrap.js"</script>
</head>

<body>
	<div class="Container">
		<header>
			<div class="divTitle">
				<h1>Student Entry Form</h1>	
			</div>
	 	</header>
	</div>
	<div class="form-div">
		<form role="form" action="csvWrite.php" method="post">
			<div class="form-group">
				<p>
					<label>Name:</label>
					<input type="text" name="formName" class="form-control" maxlength="50" placeholder="Enter the Name"/>
				</p>
			</div>
			<div class="form-group">
				<p>
					<label>Last name:</label>
					<input type="text" name="formLastName" class="form-control" maxlength="50" placeholder="Enter the Last Name"/>
				</p>
			</div>
			<div class="form-group">
				<p>
					<label>Email:</label>
					<input type="email" name="formEmail" class="form-control" maxlength="50" placeholder="Enter Email"/>
				</p>
			</div>
			<div class="form-group">
				<p>
					<label>Phone:</label>
					<input type="text" name="formPhone" class="form-control" maxlength="50" placeholder="Enter Phone Number"/>
				</p>
			</div>
			<div class="form-group">
				<p>
					<label>ID:</label>
					<input type="text" name="formID" class="form-control" maxlength="50" placeholder="Enter ID"/>
				</p>
			</div>			
			<div class="btn">
				<button type="submit" name="formSubmit" class="btn btn-primary" value="Submit">Submit</button>
			</div>	
		</form>
	</div>
</body>
</html>