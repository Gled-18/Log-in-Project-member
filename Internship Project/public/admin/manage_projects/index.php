<?php require_once('../../../private/initialize.php');
session_start();
require_login();


  $project_set = find_all_projects();
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
  <div>
    <h1>All Projects</h1>
    <div>
      <a href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to main menu</a>
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

        <?php while($project = mysqli_fetch_assoc($project_set)) { ?>
          <tr>
            <td><?php echo $project['ID'];?></td>
            <td><?php echo $project['title'];?></td>
            <td><?php echo $project['category'];?></td>
            <td><?php echo $project['submitted_date'];?></td>
            <!-- <td><?php echo $project['description'];?></td> -->
            <td><a href="<?php echo url_for('/admin/manage_projects/show.php?id=' .  $project['ID']); ?>" class="action">View</a></td>
            <td><a href="<?php echo url_for('/admin/manage_projects/delete.php?id=' . $project['ID']); ?>" class="action">Delete</a></td>
          </tr>
          <?php } ?>
      </table>
      <?php mysqli_free_result($project_set); ?>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>