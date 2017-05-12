<?php
/**
 * Created by PhpStorm.
 * User: Junaid
 * Date: 19-Nov-16
 * Time: 2:50 PM
 */
session_start();
?>


<?php
if(isset($_SESSION['username'])) {
    include "header.php";
}
else{ ?>

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
<?php }

$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch($action){
    case "submitted": submitForm(); break;
    case "error":	  retryPrompt(); break;
    default:		displayform(); break;
}
?>



<?php
function retryPrompt(){
    echo "<br><i> Error sending email, Please retry</i><br> ";
    displayform();
}

function displayform(){
    global $errormessage;

    echo "<div><h2> CONTACT FORM </h2></div>";
    echo "<table class='table table-hover'>
			<form action='contact.php?action=submitted' method='post'>
			<tr><td>Your Name </td>
				<td><input type='text' name='cf_name' style='width:300px;'></td>
			</tr>
			<tr><td>Your Email</td>
				<td><input type='text' name='cf_email' style='width:300px;'></td>
			</tr>
			<tr><td>Message</td>
				<td><textarea name='cf_message' style='width:500px;height:250px;'></textarea></td>
			</tr>
			<tr><td>
				<input type='submit' value='Send' class='btn btn-default'>
				<input type='reset' value='Clear' class='btn btn-default'>
			</td></tr>
			</form>
		</table>"
    ;
}

function submitForm(){
    require "phpmailer\PHPMailerAutoload.php";
    $mail_to = "sheikhjunaidjamshed@gmail.com";
    $name = $_POST['cf_name'];
    $email = $_POST['cf_email'];
    $message = $_POST['cf_message'];
    $subject = 'Message from a site visitor '.$name;

    $body_message= 'From '.$name.'\n';
    $body_message= 'via '.$email.'\n';
    $body_message= 'Message: '.$message.'\n';

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    $mail = new PHPMailer;
    #$mail->isSMTP();
    $mail->Host="ssl://smtp.gmail.com";
    $mail->Port = 25;
    $mail->SMTPAuth=true;
    $mail->Username="junisheikh@gmail.com";
    $mail->Password="compact=456";
    $mail->SMTPSecure="tls";
    $mail->SMTPDebug = 4;
    $mail->From=$mail_to;
    $mail->FromName="JJ";
    $mail->addAddress($mail_to, $name);
    $mail->addReplyTo($email, $name);
    $mail->WordWrap=50;
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body_message;
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }

    echo "<br><i>Your response has been sent</i><br>";
    displayform();
}

?>

<script>
    document.title = "Contact Us";
</script>
<?php require "footer.php";?>
