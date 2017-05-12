	<html lang="en">

	<head>
		<title> Login </title>
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
					<a href="registerForm.php">Register</a>
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
							<input type="hidden" name="login" value="true"/>
							<table class="table table-hover">
							<h3>YOBO Admin Login</h3>
							<?php if(isset($results['successMessage'])){ ?><div class='errorMessage'> </div><?php echo $results['successMessage'];} ?>
							<form action = "admin.php?action=login" method="post" style="width: 50%">
									<tr>
										<td>    <lable for="username"> Username </lable>  </td>
										<td>    <input type="text" name="username" id="username" placeholder="Your admin username" </td>
									</tr>
									<tr>
										<td>    <lable for="password"> Password</lable></td>
										<td>    <input type="password" name="password" id="password" placeholder="Your admin password" </td>
									</tr>
									<tr>
										<td><input type="submit" name="login" value="Login" class="btn btn-default"/></td>
										<td></td>
									</tr>
									<tr></tr>
							</form><?php   if(isset($results['errorMessage'])){ echo $results['errorMessage'];}?><br>

<tr><td><?php require "footer.php" ?></td><td></td></tr></table>


								</table>
							</div>
						<br>
<? require "footer.php" ?>
