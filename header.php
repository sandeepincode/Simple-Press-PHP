<?php
/**
 * Created by PhpStorm.
 * User: Junaid
 * Date: 07-Nov-16
 * Time: 7:29 PM
 */

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
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>


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
                <form action="admin.php?action=search" method ="post">
                    <input type="text" name="searchTarget" style="height: 50%;">
                    <input type="submit" name="search" value="Search" class="btn btn-default"/>
                </form>
            </li>
            <li>

            </li>
            <li>
                <a href="admin.php">Dashboard</a>
            </li>
            <li>
                <a href="admin.php?action=newArticle">Add New Article</a>
            </li>
            <li>
                <a href="admin.php?action=allArticle">All Articles</a>
            </li>
            <li>
                <a href="gallery.php">Gallery</a>
            </li>
            <li>
                <a href="contact.php">Contact Admin</a>
            </li>
            <li>
                <a href="admin.php?action=profile">My Profile</a>
            </li>
            <li>
                <a href="admin.php?action=logout">Logout</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="frontend/blog.php"><img id="logo" src="media/yobo.jpg" alt="XYZ News" height="10%" width="10%" /></a>
                    <label>Go to Blog</label>
