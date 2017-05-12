<?php
/**
 * Genereted by PHPStorm
 * Author: Junaid
 * Dated: 22-Nov-2016
 */
require "config.php";

//if user isnt logged in
if(!isset($_SESSION['username'])){
    header ("Location: admin.php");
}


require "header.php";

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "select * from gallery";
$result = mysqli_query($conn, $sql);

$uploadErr = "";
    ?>
        <div>
            <form action="" method="post" id="urlform" onsubmit=" return testurl();">
                Image URL: <input type='input' name="srclink" id='url' />
                    <span class="error"> <?php echo $uploadErr ?> </span>
                <button type="submit" name="btn-upload" class="btn btn-default">Upload</button>
                <br> Please paste image source links from the world wide web
            </form>
        </div>
<?php
echo "<div>";
    while($row = mysqli_fetch_assoc($result)){
        $src = $row['src'];
        echo "<a class='fancybox' rel='gallery-demo' href='".$src."'>
        <img src='".$src."' width='200' height='150'> </a>";
    }
echo "</div><br>"
?>

<?php
if(isset($_POST['btn-upload'])){
    $temp_src = $conn->escape_string(strip_tags($_POST['srclink']));
        $upload = "INSERT INTO gallery(src, caption) values('$temp_src', 'demo')";
        $yo = mysqli_query($conn, $upload);

        //image uploaded, refreshing page now
      echo "<meta http-equiv=\"refresh\" content=\"0;URL='gallery.php'\">";
}
?>
<script>
//    document.getElementById("urlform").
//        = function() {testurl()};

    function testurl(){
        var str = document.getElementById("url").value;
        if(str.match(/\.(jpeg|jpg|gif|png)$/)){
           // alert("Shit is true");
            return true;
        }
        else
            alert("URL invalid: "+str);
        return false;
    }
</script>
<script>
    document.title = "Gallery";
</script>

<?php include "footer.php"; ?>