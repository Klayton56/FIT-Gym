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
	$delete=$_GET['d'];
	if($delete!=""){
		mysqli_query($t, "delete from user where userid='$delete'");
		header("Location: add_user.php");
	}
	
	$edit=$_GET['e'];	
	if($edit!="" and $edit!=1){
		$sql1=mysqli_query($t, "select * from user where userid='$edit'");
		$edit_user=mysqli_fetch_array($sql1);
	}
	
	
?>




<?php include('menu.php');?>


<br><br>

<form action="action.php" method="post">
<table border="0" width="300px" align="center">
<tr>
	<td colspan="2" align="center">
		Add User
		<hr>
	</td>
</tr>
<tr>
		<td colspan="2" align="center" style="color:red">
			<?php
				
				echo $_SESSION['msg'];
				$_SESSION['msg']="";
			?>
		</td>
</tr>
<tr>
	<td>Name</td>
	<td><input type="text" name="name" value="<?php echo $edit_user['name'];?>"></td>
</tr>
<tr>
	<td>Phone</td>
	<td><input type="text" name="phone" value="<?php echo $edit_user['phone'];?>"></td>
</tr>
<tr>
	<td>Email</td>
	<td><input type="text" name="email" value="<?php echo $edit_user['email'];?>"></td>
</tr>
<tr>
	<td>Address</td>
	<td>
		<textarea name="address"><?php echo $edit_user['address'];?></textarea>
	</td>
</tr>
<tr> 		
	<td>Username</td>
	<td><input type="text" name="username" <?php if($edit!=""){echo "disabled";}?>></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" name="password" <?php if($edit!=""){echo "disabled";}?> ></td>
</tr>
<tr>
	<td>Confirm Password</td>
	<td><input type="password" name="cpassword" <?php if($edit!=""){echo "disabled";}?>></td>
</tr>
<tr>
	<td>User Type</td>
	<td>
		<select name="usertype" <?php if($edit!=""){echo "disabled";}?>>
			<option value="">Select</option>
			<option value="Member">Member</option>
			<option value="Admin">Admin</option>
		</select>
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type="hidden" name="editid" value="<?php echo $edit;?>">
		<input type="submit" value="<?php if($edit!=""){echo "Edit User";} else{echo "Add User";}?>" name="action">
	</td>
</tr>
</table>
</form>

<br><br>
<table border="1" width="800px" align="center">
<tr>
	<td>Sl NO</td>
	<td>Name</td>
	<td>Phone</td>
	<td>Address</td>
	<td>Email</td>
	<td>Username</td>
	<td>User Type</td>
	<td>Edit</td>
	<td>Delete</td>
</tr>
<?php
$i=1;
$sql=mysqli_query($t,"select * from user where userid!=1");
while($u=mysqli_fetch_array($sql)){
?>
<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $u['name'];?></td>
	<td><?php echo $u['phone'];?></td>
	<td><?php echo $u['address'];?></td>
	<td><?php echo $u['email'];?></td>
	<td><?php echo $u['username'];?></td>
	<td><?php echo $u['usertype'];?></td>
	<td>	<a href="add_user.php?e=<?php echo $u['userid'];?>">Edit</a>	</td>
	<td>	<a href="javascript:deleteuser(id=<?php echo $u['userid'];?>)">Delete</a>	</td>
</tr>
<?php 
$i++;
}
?>
</table>

<?php
}
?>
</body>
</html>



<script language="javascript">
function deleteuser(id){
	var msg=confirm("Are you sure you want to delete this user?");
	if(msg){window.location="add_user.php?d="+id;}
}
</script>








