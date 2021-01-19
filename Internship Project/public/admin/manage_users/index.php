<?php require_once('../../../private/initialize.php');
session_start();
require_login();

  $user_set = find_all_users();
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
  <h1>Manage Users</h1>
  <div>
    <a href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to main menu</a>
  </div>
  <div>
    <a href="<?php echo url_for('/admin/manage_users/new.php'); ?>">&laquo; Create a new user</a>
  </div>

  <table>
        <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Type</th>
        <!-- <th>Description</th> -->
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>

        <?php while($user = mysqli_fetch_assoc($user_set)) { ?>
          <tr>
            <td><?php echo $user['ID'];?></td>
            <td><?php echo $user['username'];?></td>
            <td><?php echo $user['type'];?></td>
            <!-- <td><?php echo $user['description'];?></td> -->
            <td><a href="<?php echo url_for('/admin/manage_users/show.php?id=' .  $user['ID']); ?>" class="action">View</a></td>
            <td><a href="<?php echo url_for('/admin/manage_users/delete.php?id=' . $user['ID']); ?>" class="action">Delete</a></td>
          </tr>
          <?php } ?>
      </table>
      <?php mysqli_free_result($user_set); ?>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>