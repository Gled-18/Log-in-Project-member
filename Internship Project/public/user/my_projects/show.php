<?php   
  require_once('../../../private/initialize.php');
  session_start();
  require_login();
  

  $id = $_GET['id'] ?? '1';
  $project = find_project_by_id($id);
  $member_set = find_project_member_by_project_id($id);
  $role = get_user_role($project['ID'], $_SESSION['user_id']);
  $_SESSION['project_id'] = $project['ID']; //to use for add member

  if(is_post_request()){
    redirect_to(url_for('/user/my_projects/add_user.php'));
  }
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <div>
      <a href="<?php echo url_for('/user/index.php'); ?>">&laquo; Back to main menu</a>
      <a href="<?php echo url_for('/user/my_projects/index.php?id='. $_SESSION['user_id']); ?>">&laquo; Back My Projects</a>
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
            <?php if($role === "admin") {?>
            <td><a href="<?php echo url_for('/user/my_projects/remove_user.php?id=' . $member['ID']); ?>" class="action">Delete</a></td>
            <?php } ?>
          </tr>
        <?php } ?>
      </table>
      <?php mysqli_free_result($member_set); ?>
    </div>

    <div>
    <?php if($role === "admin"){ ?>
    <form action="<?php echo url_for('/user/my_projects/show.php?id='. $project['ID']) ?>" method="post">
      <div>
        <input type="submit" name="commit" value="Add  members" />
      </div>
    </form>
    <?php } ?>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>