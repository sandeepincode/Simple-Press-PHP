<?php
/**
 * Created by PhpStorm.
 * User: Junaid
 * Date: 07-Nov-16
 * Time: 7:34 PM
 */
require "config.php";

require "header.php";
echo "<h1>this is a demo page to retrive content from Article TEST8 and standard print body to do shit with it.</h1>";
$connect = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sqlLogin = "SELECT * FROM articles WHERE title='test29'";
$result = mysqli_query($connect, $sqlLogin);
$row = mysqli_fetch_assoc($result);

echo $row['content'];

require "footer.php";

?>