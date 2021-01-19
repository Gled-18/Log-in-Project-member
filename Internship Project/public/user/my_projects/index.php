<?php require_once('../../../private/initialize.php');
session_start();
require_login();

  $id = $_SESSION['user_id'];
  $my_project_set = find_user_project($id);
  
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
  <div>
    <h1>My Projects</h1>
    <div>
      <a href="<?php echo url_for('/user/index.php'); ?>">&laquo; Back to main menu</a>
      <a href="<?php echo url_for('/user/my_projects/new.php'); ?>">&laquo; Create New Project</a>
    </div>
  </div>
<table>
        <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Date</th>
        <!-- <th>Description</th> -->
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>

        <?php while($my_project = mysqli_fetch_assoc($my_project_set)) { ?>
          <?php $project = find_project_by_id($my_project['project_id']); ?>
          <?php $role = get_user_role($my_project['project_id'], $_SESSION['user_id']); ?>
          <tr>
            <td><?php echo $my_project['project_id'];?></td>
            <td><?php echo $project['title'];?></td>
            <td><?php echo $project['category'];?></td>
            <td><?php echo $project['submitted_date'];?></td>
            <!-- <td><?php echo $my_project['description'];?></td> -->
            <td><a href="<?php echo url_for('/user/my_projects/show.php?id=' .  $my_project['project_id']); ?>" class="action">View</a></td>
            <td><a href="<?php echo url_for('/user/my_projects/edit.php?id=' .  $my_project['project_id']); ?>" class="action">Edit</a></td>
            <?php if($role === "admin") {?>
            <td><a href="<?php echo url_for('/user/my_projects/delete.php?id=' . $my_project['project_id']); ?>" class="action">Delete</a></td>
            <?php } ?>
          </tr>
          <?php } ?>
      </table>
      <?php mysqli_free_result($my_project_set); ?>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>