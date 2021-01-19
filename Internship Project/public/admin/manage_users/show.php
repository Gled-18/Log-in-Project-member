<?php   
  require_once('../../../private/initialize.php');
  session_start();
  require_login();

  $id = $_GET['id'] ?? '1';
  $user = find_user_by_id($id);
  $project_set = find_project_member_by_user_id($id);
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <div>
      <a href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to main menu</a>
      <a href="<?php echo url_for('/admin/manage_users/index.php'); ?>">&laquo; Back to users</a>
    </div>
    <div><h1>User Info</h1></div>
    <div>
      <dl>
        <dt>Username</dt>
        <dd><?php echo $user['username']; ?></dd>
      </dl>
      <dl>
        <dt>Name</dt>
        <dd><?php echo $user['name']; ?></dd>
      </dl>
      <dl>
        <dt>Surname</dt>
        <dd><?php echo $user['surname']; ?></dd>
      </dl>
      <dl>
        <dt>Type</dt>
        <dd><?php echo $user['type']; ?></dd>
      </dl>
    </div>
    <div>
      <table>
        <tr>
          <th>Project ID</th>
          <th>Project Name</th>
          <th>Type</th>
        </tr>
        <?php while($project = mysqli_fetch_assoc($project_set)) { ?>
        <?php $p = find_project_by_id($project['project_id'])?>
          <tr>
            <td><?php echo $p['ID']?></td>
            <td><?php echo $p['title']?></td>
            <td><?php echo $project['role']?></td>
          </tr>
        <?php } ?>
      </table>
      <?php mysqli_free_result($project_set); ?>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>