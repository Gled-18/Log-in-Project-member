<?php 
  require_once('../../../private/initialize.php');
  session_start();
  require_login();

  $id = $_GET['id'];
  if(is_post_request()){
    $result = delete_project($id);
    redirect_to(url_for('/admin/manage_projects/index.php?id='. $_SESSION['user_id']));
  }else{
    $project = find_project_by_id($id);
  }

?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
  <a href="<?php echo url_for('/admin/manage_projects/index.php?id='. $_SESSION['user_id']); ?>">Back to Projects</a>
  <div>
    <h1>DELETE PROJECT</h1>
    <p>Are you sure you want to delete this project?</p>
    <p><?php echo $project['title']; ?></p>
    <form action="<?php echo url_for('/admin/manage_projects/delete.php?id='. $project['ID']) ?>" method="post">
      <div>
        <input type="submit" name="commit" value="Delete Project" />
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>