<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>yobo</title>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<style>
		.carousel,.item,.active{height:100%; width: 100%;overflow: hidden;align-item: center;}
		.carousel-inner{height:100%;  width: 100%;overflow: hidden;align-item: center;}
	</style>
	
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <div class="navbar-brand"><img style="width: 50px; height: 50px; border-radius: 50px; margin-top: -14px; margin-left: -12px;" title="logo" src='img/yobo.jpg' /></div>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="blog.php">Home</a>
                    </li>
                    <li>
                        <a href="aboutme.php">About Devs</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="../admin.php">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<div id="mycarousel" class="carousel slide" data-ride="carousel">  
	  <!-- Wrapper for slides -->
	    <div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src= 'https://images.duckduckgo.com/iu/?u=http%3A%2F%2Fi.huffpost.com%2Fgen%2F1645150%2Fimages%2Fo-RICK-ASTLEY-NEVER-GONNA-WAKE-UP-facebook.jpg&f=1' alt="Trolled">
					<div class="carousel-caption">
						<h3>Please Add Images</h3>
					</div>
				</div>
				<?php printImages();?>
				
		</div>
				  <!-- Controls -->
				  <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
	</div>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <p class="copyright text-muted">Copyright &copy; YoBo Blog 2016</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
	
    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>
	<script>$('.carousel').carousel({
	interval: 6000
	});</script>

</body>
<?php
		
		function returnNumberOfImages(){
			$conn = startConnection();
			$sql = "SELECT COUNT(*) FROM Gallery";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$size = $row['COUNT(*)'];
			mysqli_close($conn);
			return $size;
     }
	 
		function printImages(){
			$conn = startConnection();//connect to the database
			$index = 1;
			$size = returnNumberOfImages();
			for($index = 1;$index <= $size;$index++){
			$sql = "SELECT * FROM 'gallery' WHERE 'id' =".$index;
			$row = mysqli_fetch_assoc($conn,$result);
			$link = $row['src'];
			$caption = $row['caption'];
			if($link == NULL || $link ==""){
				$link = "https://images.duckduckgo.com/iu/?u=http%3A%2F%2Fi.huffpost.com%2Fgen%2F1645150%2Fimages%2Fo-RICK-ASTLEY-NEVER-GONNA-WAKE-UP-facebook.jpg&f=1";
			}
							echo"<div class=\"item\">"
								."<img src=\'".$link."\' alt=\"Blogger Image\">"
								."<div class=\"carousel-caption\">"
								."<h3>".$caption."</h3>"
								."</div>"
								."</div>";
					}
		}
?>
</html>