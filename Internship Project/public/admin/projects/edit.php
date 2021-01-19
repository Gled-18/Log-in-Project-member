<?php require_once('../../../private/initialize.php');
session_start();
require_login();
$id = $_GET['id'];
$errors = null;
if(is_post_request()){
  $project = [];
  $project['ID'] = $id;
  $project['title'] = $_POST['title'] ?? '';
  $project['category'] = $_POST['category'] ?? '';
  $project['description'] = $_POST['description'] ?? '';

  $result = update_project($project);
  if($result === true){
    redirect_to(url_for('admin/projects/show.php?id=' . $project['ID']));
  }else{
    $errors = $result;
    // echo display_errors($errors);
  }
}else{
  $project = find_project_by_id($id);
}
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <a href="<?php echo url_for("/admin/projects/index.php?id=" . $_SESSION['user_id'])?>">Back</a>
  <div>
    <h1>UPDATE PROJECT</h1>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for("/admin/projects/edit.php?id=". $project['ID']); ?>" method="post">
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="<?php echo $project['title'] ?>"></dd>
      </dl>
      <dl>
        <dt>Category</dt>
        <dd><input type="text" name="category" value="<?php echo $project['category'] ?>"></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><input type="text" name="description" value="<?php echo $project['description'] ?>"></dd>
      </dl>
      <div>
          <input type="submit" value="Update Project" />
      </div>
    </form>
  </div>
  <?php include(SHARED_PATH . '/footer.php'); ?>