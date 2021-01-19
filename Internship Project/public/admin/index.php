<?php 
  require_once('../../private/initialize.php');
  session_start();
  require_login();
  
  
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
  <div>
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/admin/manage_users/index.php'); ?>">Manage Users</a></li>
      <li><a href="<?php echo url_for('/admin/manage_projects/index.php'); ?>">Manage Projects</a></li>
      <li><a href="<?php echo url_for('/admin/projects/index.php?id=' . $_SESSION['user_id']); ?>">My Projects</a></li>
      <form method='post' action="<?php echo url_for('logout.php'); ?>">
            <input type="submit" value="Logout" name="logout">
        </form>

    </ul>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>