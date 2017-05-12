<?php
/**
 * Created by PhpStorm.
 * User: Junaid Shakoor
 * Date: 10-Nov-16
 */
require "header.php";
?>

<div id="adminheader">
    <p> You're logged in as <b> <?php echo $_SESSION['username']?></b>.
        <a href="admin.php?action=logout"> Logout</a>
    </p>
</div>

<h1> <?php echo $results['pageTitle']?></h1>
    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>">

        <?php if(isset($results['errorMessage'])){ ?>
        <div class='errorMessage'> <?php echo $results['errorMessage'] ?> <div>
                <?php }     $title= "nothing ? :P " ?>

                <table class="table">
                    <tr>
                        <td><label for="posted">Status</label></td>
                        <td>
                            <?php
                            $pubcheck = $results['article']->posted == 1 ? "checked" : "";
                            $dracheck = $results['article']->posted == 0 ? "checked" : "";
                            echo "<input type='radio' name='posted' value='1'".$pubcheck."> Published <br>";
                            echo "<input type='radio' name='posted' value='0'".$dracheck."> Draft <br>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td> <label for="author" >Author</label></td>
                        <td>
                            <select name="author">
                                <?php
                                    foreach($results['authorList'] as $author) {
                                        if($results['article']->author == $author){
                                            echo "<option value='" . $author . "' selected>" . $author . "</option>";
                                        }
                                        else
                                            echo "<option value='" . $author . "'>" . $author . "</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> <label for="title"> Article Title</label> </td>
                        <td> <input type="text" name="title" id="title" placeholder="Name of the article" autofocus maxlength="255"
                                     value="<?php echo htmlspecialchars($results['article']->title) ?>" required>
                        </td>
                    </tr>

                    <tr>
                        <td>  <label for="summary"> Article Summary</label></td>
                        <td> <textarea type="text" name="summary" id="summary" placeholder="Summarize the article in a few lines" required maxlength="1000"
                                  style="width: 100%; max-width: 700px;"><?php echo htmlspecialchars( $results['article']->summary )?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="content">Article Content</label></td>
                        <td style="height:150%">     
                            <textarea class ="ckeditor" name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000"
                                              style="width: 100%; max-width: 700px;" ><?php echo htmlspecialchars( $results['article']->content )?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>   <label for="publication">Publication Date</label></td>
                        <td>   <input type="date" placeholder="YYYY-MM-DD" id="publication" name="publication" required maxlength="10"
                               value="<?php echo $results['article']->publication ? date( "Y-m-d", strtotime(str_replace('-','/', $results['article']->publication ))) : "" ?>" >
                        </td>
                    </tr>

                    <tr>
                        <td>   <label for="tags">Tags</label></td>
                        <td>   <textarea name="tags" id="tags" placeholder="Single word tags, seperated by commas" required maxlength="100"
                                  style="width: 50%; max-width: 500px;" s><?php echo htmlspecialchars( $results['article']->tags )?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><!-- Phantom TD --></td>
                        <td><button type="submit" formaction="frontend/temparticle.php" 
                                    formmethod="POST" class="btn btn-default">Preview Article</button></td>
                    </tr>
                </table>

                <br>
                <div class="buttons">
                      <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-default"/>
                      <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-default" /><br>
                </div>
    </form>

<?php if ( $results['article']->id ) { ?>
          <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>"
                onclick=" return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( '.ckeditor' );
</script>

<script>
    document.getElementById("title").onchange
    = function() {checkTitle()};

    function checkTitle(){
        var str = document.getElementById("title").value;
        var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/); //unacceptable chars
        if(pattern.test(str)){
            title.style.background = "pink";
            alert("Title is invalid, please refill");
        }
    }
</script>

<?php include "footer.php" ?>