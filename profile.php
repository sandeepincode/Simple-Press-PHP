<?php
require "header.php";
?>

<!-- <div id="adminheader">
    <p> You're logged in as <b> <?php echo $_SESSION['username']?></b>.
        <a href="admin.php?action=logout"> Logout</a>
    </p>
</div> -->



<div class="form-LoginLog">
  <table class="table table-hover">
    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="profile"/>
        <h1> <?php echo $results['pageTitle']?></h1>
        <?php if(isset($results['errorMessage'])){ ?>
        <div class='errorMessage'> <?php echo $results['errorMessage'];} ?> </div>
            <?php if(isset($results['successMessage'])){ ?>
            <div class='errorMessage'> <?php echo $results['successMessage'];} ?></div>
                <tr>
                    <td><label>Current Password</label></td>
                    <td><input type="password" name="curPass" id="password" placeholder="Current Password"</td>
                  </tr>
                  <tr>
                    <td><label>New Password</label></td>
                    <td><input type="password" name="newPass" id="password" placeholder="New Password"</td>
                  </tr>
                  <tr>
                    <td><label>Confirm New Password</label></td>
                    <td><input type="password" name="conNewPass" id="password" placeholder="Confirm New Password"</td>
                  </tr>
                </tr>
                <tr>
                    <td><label>New Name</label></td>
                    <td><input type="text" name="newName" id="username" placeholder="New Name"</td>
                <tr>
                    <td><input type="submit" name="profile" value="Save" class="btn btn-default"/></td>
                    <td></td>
                </tr>

    </form>
</div>
<tr><td><?php require "footer.php";?></td><td></td></tr>
</table>
