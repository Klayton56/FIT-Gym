<?php
session_start();	
$t=mysqli_connect("localhost","bacbd", "111", "dailybooks");

	
extract($_POST);

if($_POST['action']=="Login"){
	
	if($_POST['username']=="" or $_POST['password']=="") 
	{	
		$_SESSION['msg']="Fill the gaps";
		header("Location: login.php");
	}
	else
	{
		$_SESSION['u']=$_POST['username'];
		$_SESSION['p']=$_POST['password'];
		
		
		$sql=mysqli_query($t, "select * from user where username='$_SESSION[u]' and password='$_SESSION[p]'");
		$count=mysqli_num_rows($sql);	
		
		$xyz=mysqli_fetch_array($sql);
		$_SESSION['t']=$xyz['usertype'];
		
		if($count==1){header("Location: dashboard.php");}
		else{
			$_SESSION['msg']="Wrong username or password";
			header("Location: login.php");		
		} 	
	}
}


if($_POST['action']=="Add User"){

	
	if($_POST['name']=="" or $_POST['phone']=="" or $_POST['email']=="" or $_POST['address']=="" or $_POST['username']=="" or $_POST['password']=="" or $_POST['usertype']=="") 
	{	
		$_SESSION['msg']="Fill the gaps";
		header("Location: add_user.php");
	}
	else{
		$sql1=mysqli_query($t, "select * from user where email='$_POST[email]' or username='$_POST[username]'");
		$count=mysqli_num_rows($sql1);
		if($count==1){
			$_SESSION['msg']="Email or username is already used";
			header("Location: add_user.php");
		}
		else{
			mysqli_query($t, "insert into user(userid, name, phone, address, email, username, password, usertype) values(null, '$_POST[name]', '$_POST[phone]', '$_POST[address]', '$_POST[email]', '$_POST[username]', '$_POST[password]', '$_POST[usertype]')");
			$_SESSION['msg']="Successfully added";
			header("Location: add_user.php");
		}
	}
	
}


if($_POST['action']=="Edit User"){
	if($_POST['name']=="" or $_POST['phone']=="" or $_POST['email']=="" or $_POST['address']=="") 
	{	
		$_SESSION['msg']="Fill the gaps";
		header("Location: add_user.php");
	}
	else{
		mysqli_query($t,"update user set name='$_POST[name]', phone='$_POST[phone]', email='$_POST[email]', address='$_POST[address]' where userid='$_POST[editid]'");
		$_SESSION['msg']="Successfully edited";
		header("Location: add_user.php");
	}
}

if($_POST['action']=="Change Password"){
	if($_POST['current']=="" or $_POST['new']=="" or $_POST['confirm']=="") 
	{	
		$_SESSION['msg']="Fill the gaps";
		header("Location: change_password.php");
	}
	else{          
		if($_POST['current']!=$_SESSION['p']){
			$_SESSION['msg']="Current password is not matching";
			header("Location: change_password.php");
		}
		else{
			if($_POST['new']!=$_POST['confirm']){
				$_SESSION['msg']="New and confirm passwords are not matching";
				header("Location: change_password.php");
			}
			else{
				mysqli_query($t,"update user set password='$_POST[new]' where username='$_SESSION[u]'");
				$_SESSION['msg']="Successfully changed and login again";
				header("Location: logout.php");
			}
		}
	}
}
if($_POST['action']=="Add Book"){

	
	if($_POST['title']=="" or $_POST['author']=="" or $_POST['year']=="" or $_POST['genre']=="" or $_POST['price']=="" or $_POST['quantity']=="") 
	{	
		$_SESSION['msg']="Fill up the required feilds";
		header("Location: add_books.php");
	}
	else{
		$sql1=mysqli_query($t, "select * from book where title='$_POST[title]' and author='$_POST[author]'");
		$count=mysqli_num_rows($sql1);
		if($count==1){
			$_SESSION['msg']="Title or author is already used";
			header("Location: add_books.php");
		}
		else{
			mysqli_query($t, "insert into book(bookid, title, author, year, genre, price, quantity) values(null, '$_POST[title]', '$_POST[author]', '$_POST[year]', '$_POST[genre]', '$_POST[price]', '$_POST[quantity]')");
			$_SESSION['msg']="Successfully added";
			header("Location: add_books.php");
		}
	}
	
}


if($_POST['action']=="Edit Book"){
	if($_POST['title']=="" or $_POST['author']=="" or $_POST['year']=="" or $_POST['genre']=="" or $_POST['price']==""or $_POST['quantity']=="") 
	{	
		$_SESSION['msg']="Fill the gaps";
		header("Location: add_books.php");
	}
	else{
		mysqli_query($t,"update book set title='$_POST[title]', author='$_POST[author]', year='$_POST[year]', genre='$_POST[genre]', price='$_POST[price]', quantity='$_POST[quantity]' where bookid='$_POST[editid]'");
		$_SESSION['msg']="Successfully edited";
		header("Location: add_books.php");
	}
}

if($_POST['action']=="Borrow"){
	mysqli_query($t, "insert into borrow(borrowid, bookid, username, issuedate, duedate) values(null, '$_POST[bookid]', '$_SESSION[u]', '$_POST[issue]', '$_POST[due]')");
	$_SESSION['msg']="Successfully borrowed";
	header("Location: borrow_books.php");
}
if($_POST['action']=="Cart"){
	mysqli_query($t, "insert into cart(orderid, userid, price, bookid, status) values(null, '$_POST[bookid]', '$_POST[userid]','$_POST[price]','$_POST[status]')");
	$_SESSION['msg']="Successfully added to cart";
	header("Location: buybook_books.php");
}

?>

 












