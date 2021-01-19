<?php   
  require_once('../../../private/initialize.php');
  session_start();
  require_login();

  $id = $_GET['id'] ?? '1';
  $project = find_project_by_id($id);
  $member_set = find_project_member_by_project_id($id);
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <div>
      <a href="<?php echo url_for('/user/index.php'); ?>">&laquo; Back to main menu</a>
      <a href="<?php echo url_for('/user/projects/index.php'); ?>">&laquo; Back Projects</a>
    </div>
    <div>
      <h1>Title: <?php echo $project['title']; ?></h1>
    </div>
    <div>
      <dl>
        <dt>Project Title</dt>
        <dd><?php echo $project['title']; ?></dd>
      </dl>
      <dl>
        <dt>Category</dt>
        <dd><?php echo $project['category']; ?></dd>
      </dl>
      <dl>
        <dt>Submitted</dt>
        <dd><?php echo $project['submitted_date']; ?></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><?php echo $project['description']; ?></dd>
      </dl>
    </div>

    <div>
      <table>
        <tr>
          <th>User ID</th>
          <th>Username</th>
          <th>Type</th>
        </tr>
        <?php while($member = mysqli_fetch_assoc($member_set)) { ?>
        <?php $user = find_user_by_id($member['user_id'])?>
          <tr>
            <td><?php echo $user['ID']?></td>
            <td><?php echo $user['username']?></td>
            <td><?php echo $member['role']?></td>
          </tr>
        <?php } ?>
      </table>
      <?php mysqli_free_result($member_set); ?>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>