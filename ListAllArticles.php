<?php
/**
 * Created by PhpStorm.
 * User: Junaid
 * Date: 18-Nov-16
 * Time: 1:48 AM
 */
require "header.php";

?>

<div id="adminHeader">
    <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
</div>

<?php print "<h1>".$results['pageHeading']."</h1>";?>

 
      <table class = "table table-hover">
        <tr>
            <th>Publication Date</th>
            <th>Heading</th>
            <th>Author </th>
            <th>Status</th>
       </tr>
     
    <?php foreach ( $results['articles'] as $article ) { ?>
         
        <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>'">
          <td><?php echo $article->publication?></td>
          <td><?php echo $article->title?>      </td>
          <td><?php echo $article->author?>     </td>
          <td><?php
               echo $article->posted == 1 ? "Published" : "Draft";
              ?>
          </td>    
        </tr>
         
    <?php } ?>
     
          </table>

<p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
<p><a href="admin.php?action=newArticle">Add a New Article</a></p>

<?php require "footer.php"?>
