<html>
<head>
</head>
<style>
body{ 
        background-image: url("https://webcomicms.net/sites/default/files/clipart/129706/books-images-129706-6026490.jpg")
    }
      h2{
	  background-color: #994d00;
	}
</style>

<body style="font-family:Helvetica-Bold">
 
	<h2 align="center" style="color:Cornsilk">DailyBooks</h2>
	
	<form action="action.php" method="post">
	<table border="0" width="250px" height="200px" align="center">
		<tr>
			<td colspan="2" align="center">
				Login
				<hr>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" style="color:red">
			<?php
				error_reporting(E_ALL^E_NOTICE);

				session_start();
				echo $_SESSION['msg'];
				$_SESSION['msg']="";
			?>
			</td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="Login" name="action"></td>
		</tr>
	</table>
</form>
	
</body>
</html>
