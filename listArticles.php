<?php
/**
 * Created by PhpStorm.
 * User: Junaid
 * Date: 14-Nov-16
 * Time: 12:47 PM
 */
include "header.php"
?>
     
          <div id="adminHeader">
            <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['name']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
          </div>
     
<?php //.$results['heading']." -- ?>
<?php print "<h1> Heading </h1>";?>
     
<?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

<?php if ( isset( $_GET['status'] ) ) { ?>        
        <div class="errorMessage"><?php echo $_GET['status'] ?></div>
<?php } ?>
     
     
<?php if ( isset( $results['statusMessage'] ) ) { ?>
            <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
     
          <table class = "table table-hover">
            <tr>
                  <th>Publication Date</th>
                  <th>Heading</th>
                  <th>Status</th>
                </tr>
     
    <?php foreach ( $results['articles'] as $article ) { ?>
         
                <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>'">
              <td><?php echo $article->publication?></td>
              <td><?php echo $article->title?> </td>
              <td><?php
                    echo $article->posted == 1 ? "Published" : "Draft";
                  ?>
              </td>
                </tr>
         
    <?php } ?>
     
          </table>
     
          <p>Top 5 recent articles.</p>
     
          <p><a href="admin.php?action=newArticle">Add a New Article</a></p>
     
<?php include "footer.php" ?>