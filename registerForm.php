<?php
/**
 * Created by PhpStorm.
 * User: Junaid Shakoor
 * Date: 08-Nov-16
 */
?>

		<form action = "registerForm.php" method="post" style="width: 50%">
    <input type="hidden" name="register" value="true"/>

<?php

	if(isset($results['errorMessage'])){
    echo $results['errorMessage'];}

/**
 * Created by PhpStorm.
 * User: Junaid
 * Date: 07-Nov-16
 * Time: 7:29 PM
 */

require "config.php";

?>
<!-- Script to alert any issue by giving in any text -->
<script>
	function regError(text){
		alert(text);
	}
</script>

<?php
//Duplicate Method from admin.php that makes text safe to inject to SQL
function safePOSTSQLL($conn,$name){
     if(isset($_POST[$name])){
         return $conn->real_escape_string(strip_tags($_POST[$name]));
     } else {
         return "";
     }
}

//Beginning of checking for a new Registration
$options = [
	'cost' => 12,
];
$connect = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$master = safePOSTSQLL($connect, 'masterPassword');
$password = (safePOSTSQLL($connect, 'registerPassword'));
$rpassword = (safePOSTSQLL($connect, 'reRegisterPassword'));
$username = safePOSTSQLL($connect, 'registerUsername');
$results = array();
$results['pageTitle'] = "Admin Registration";
if(isset($_POST['register'])){
		if($master === "BEEPBOOP"){
			if($username != "" && $password != ""){
		    if($password === $rpassword){
		        $checkUser = "SELECT `username` FROM `userbase` WHERE username = '$username'";
		        $checkUserResult = mysqli_query($connect, $checkUser);
			        if($checkUserResult){
								$usernames = mysqli_fetch_assoc ($checkUserResult);
								if($usernames['username'] != $username){
									$name = safePOSTSQLL($connect, 'registerName');
									$createAcc = "INSERT INTO userbase(id, username, password, name) VALUES (NULL,'$username','$password','$name')";
									if(mysqli_query($connect, $createAcc)){
											echo '<script type="text/javascript"> regError("Registration Successful."); </script>';
											$successMessage = "Successfully registered! Please login";
											require_once "loginForm.php";
											header( 'Location: loginForm.php');
									}else {
											echo '<script type="text/javascript"> regError("Database connection error."); </script>';
										}
								}else{
								echo '<script type="text/javascript"> regError("Username exists, please retry"); </script>';
								}
			        }else{
								echo '<script type="text/javascript"> regError("Database connection error."); </script>';

			        }


		    }else{
						echo '<script type="text/javascript"> regError("Passwords do not match, please retry"); </script>';
		        //$results['errorMessage'] = "Passwords do not match, please retry";
		        //header( 'Location: registerForm.php');
		    }
			}else {
				echo '<script type="text/javascript"> regError("Password or Username not set."); </script>';
			}
		}else{
				echo '<script type="text/javascript"> regError("Master Password Incorrect."); </script>';
		}
}

//End Registration check


?>


<html lang="en">

<head>



	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/simple-sidebar.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>


</head>

<body>

<div id="wrapper">

	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		<ul class="sidebar-nav">
			<li class="sidebar-brand">
				<a href="admin.php"> YOBO News </a>
			</li>
			<li>
				<a href="admin.php">Dashboard</a>
			</li>
			<li>
				<a href="contact.php">Contact Admin</a>
			</li>
			<li>
				<a href="loginForm.php">Login</a>
			</li>
		</ul>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">

					<a href="frontend/blog.php"><img id="logo" src="media/yobo.jpg" alt="XYZ News" height="100px" width="100px" /></a>
					<label>Go to Blog</label>

					<div class="form-LoginLog">
						<input type="hidden" name="register" value="true"/>
						<table class="table table-hover">
							<h3>YOBO Register Admin</h3>
							<form action = "registerForm.php" method="post" style="width: 50%">
								<tr>
									<td>    <lable for="password"> Name</lable></td>
									<td>    <input type="text" name="registerName" id="Name" placeholder="Your Name" </td>
								</tr>
								<tr>
									<td>    <lable for="username"> Username </lable>  </td>
									<td>    <input type="text" name="registerUsername" id="username" placeholder="Admin Username" </td>
								</tr>
								<tr>
									<td>    <lable for="password"> Password</lable></td>
									<td>    <input type="password" name="registerPassword" id="password" placeholder="Admin Password" </td>
								</tr>
								<tr>
									<td>    <lable for="password"> Confirm Password</lable></td>
									<td>    <input type="password" name="reRegisterPassword" id="password" placeholder="Confirm Password" </td>
								</tr>
								<tr>
									<td>    <lable for="password"> Master Password</lable></td>
									<td>    <input type="password" name="masterPassword" id="masterPassword" placeholder="Master Password" </td>
								</tr>
								<tr>
									<td><input type="submit" name="register" value="Register" class="btn btn-default"/></td>
									<td></td>
								</tr>
								<tr></tr>

							</form>
<tr><td><?php require "footer.php" ?></td><td></td></tr>
</div>
