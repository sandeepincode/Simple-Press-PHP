<?php
     function getImages(){
         $img = "http://www.completecarewellnesscenter.com/wp-content/uploads/2016/09/blog_default.png"; //link
         if($img == null || $img == ""){
           echo "Image error";
         }else{
             echo "<img src=\"".$img."\" >";
         }
     }

     function getBlogTitle($count){
         //open connection to database
        $conn = startConnection();

        //get last row of table.. i.e. latest article
        $sql = "SELECT * FROM `articles` WHERE id = '$count'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $heading = $row['title'];

        if($heading == null || $heading == ""){
            $heading = "Not a valid article";
        }
        mysqli_close($conn);
        return $heading;
     }

     function getAuthor($count){
        $conn = startConnection();

        $sql = "SELECT * FROM `articles` WHERE id = '$count'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $username = $row['author'];

        if($username == null || $username == ""){
            $username = "";
        }
        mysqli_close($conn);
        return $username;
     }

     function getDatePublished($count){
        $conn = startConnection();
        $sql = "SELECT * FROM `articles` WHERE id = '$count'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $datePublished = $row['publication'];

        if($datePublished == null || $datePublished == ""){
            $datePublished = "";
        }
        mysqli_close($conn);
        return $datePublished;
     }

     function getSummary($count){
        $conn = startConnection();
        $sql = "SELECT * FROM `articles` WHERE id = '$count'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $summary = $row['summary'];
        if($summary == null || $summary == ""){
            $summary = "";
        }
        mysqli_close($conn);
        return $summary;
     }
     
     function getContent($count){
        $conn = startConnection();
        $sql = "SELECT * FROM `articles` WHERE id = '$count'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $content = $row['content'];
        if($content == null || $content == ""){
            $content = "";
        }
        mysqli_close($conn);
        return $content;
     }

     function startConnection(){
        $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }
        else{
            return $conn;
        }
     }
     
     function returnNumberOfPublishedArticles(){
        $conn = startConnection();
        $sql = "SELECT COUNT(*) FROM articles WHERE posted = '1'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $size = $row['COUNT(*)'];
        mysqli_close($conn);
        return $size;
     }
     
     function returnNumberOfArticles(){
        $conn = startConnection();
        $sql = "SELECT COUNT(*) FROM articles";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $size = $row['COUNT(*)'];
        mysqli_close($conn);
        return $size;
     }
     
    function getCorrectID($count){
        $conn = startConnection();
        $sql = "SELECT id FROM `articles` WHERE posted = '1'"; 
        $result = mysqli_query($conn, $sql);
        for($i = 0; $i < $count; $i++){
           $row = mysqli_fetch_assoc($result);
        }
        mysqli_close($conn);
        return $row['id'];
    }
    
    function articlePublished($id){
        //check if article exists
        if($id > 0){//$id <= returnNumberOfArticles() && $id > 0){
            $conn = startConnection();
            $sql = "SELECT posted FROM `articles` WHERE id = '$id'"; 
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            if($row['posted'] == 1){
                return true;
            }
            return false;
        }
    }
    
    //this function prints the next batch of articles
    function printArticles($numCalled){
        $numCalled -= 1;
        $size = returnNumberOfPublishedArticles();
        if((NUM_ARTICLES * $numCalled) < $size){
            $startIndex = (NUM_ARTICLES * $numCalled) + 1;
            if(!($size < NUM_ARTICLES * ($numCalled + 1))){
              $size = $startIndex + NUM_ARTICLES - 1;  
            }
            for($count = $startIndex; $count <= $size;$count++){//Just loop for the next batch of articles
                //get different parts of article
                $id = getCorrectID($count);
                $blogTitle = getBlogTitle($id);
                $author = getAuthor($id);
                $datePublished = getDatePublished($id);
                $BlogSummary = getSummary($id);
                echo"<div class=\"post-preview\">"
                        ."<a href=\"blogpage.php?articleNo=".$id."\" value = \"gg\">"
                            ."<h2 class=\"post-title\">"
                                .$blogTitle
                            ."</h2>"
                            ."<h3 class=\"post-subtitle\">"
                                .$BlogSummary
                            ."</h3>"
                        ."</a>"
                        ."<p class=\"post-meta\">Posted by ".$author." on the date: ".$datePublished."</p>"
                    ."</div>"
                    ."<hr>";
            }
        }
    }
    
    function printArticle($id){
        if(articlePublished($id)){
            $blogTitle = getBlogTitle($id);
            $author = getAuthor($id);
            $datePublished = getDatePublished($id);
            $BlogSummary = getSummary($id);
            $BlogContent = getContent($id);
            echo"<div class=\"post-preview\">"
                        ."<h2 class=\"post-title\">"
                            .$blogTitle
                        ."</h2>"
                        ."<h3 class=\"post-subtitle\">"
                            .$BlogSummary
                        ."</h3>"
                        .$BlogContent
                    ."<p class=\"post-meta\">Posted by ".$author." on the date: ".$datePublished."</p>"
                ."</div>"
                ."<hr>";    
        }
        else{
            echo "article not found";
        }
    }
?>