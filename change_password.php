<html>
<head>
	<style>
		body{ 
        background-image: url("https://www.industryforum.co.uk/wp-content/uploads/sites/6/2017/02/Publications-iStock-638358060.jpg")
		}	
		    td.menu{
			font-family:Helvetica-Bold;
			background-color:Cornsilk;
			
		}
	</style>
</head>
<body>

<?php
error_reporting(E_ALL^E_NOTICE);
session_start();
$t=mysqli_connect("localhost","bacbd", "111", "dailybooks");


if($_SESSION['u']=="" and $_SESSION['p']==""){
	$_SESSION['msg']="You have to login first";
	header("Location: login.php");	
}
else{
?>




<?php include('menu.php');?>


<br><br>

<form action="action.php" method="post">
	<table border="0" width="350px" align="center">
		<tr>
			<td colspan="2" align="center">
				Change Password
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
			<td>Current Password:</td>
			<td><input type="password" name="current"></td>
		</tr>
		<tr>
			<td>New Password:</td>
			<td><input type="password" name="new"></td>
		</tr>
		<tr>
			<td>Confirm Password:</td>
			<td><input type="password" name="confirm"></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" value="Change Password" name="action">
			</td>
		</tr>
	</table>
</form>

<?php
}
?>
</body>
</html>








