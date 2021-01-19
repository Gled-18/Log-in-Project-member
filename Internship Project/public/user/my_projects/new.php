<?php
  require_once('../../../private/initialize.php');
  session_start();
  require_login();

  $errors = null;
  if(is_post_request()){
    $project = [];
    $project['title'] = $_POST['title'] ?? '';
    $project['category'] = $_POST['category'] ?? '';
    $project['description'] = $_POST['description'] ?? '';

    $result = insert_project($project);
    $new_id = mysqli_insert_id($db);

    
    if($result === true){
      $member = [];
      $member['project_id'] = $new_id;
      $member['user_id'] = $_SESSION['user_id'];
      $member['role'] = "admin";
      $member = insert_project_member($member);
      redirect_to(url_for('/user/my_projects/show.php?id=' . $new_id));
    }else{
      $errors = $result;
    }
  }else{
    $project['title'] = '';
    $project['category'] = '';
    $project['description'] = '';
  }
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <a href="<?php echo url_for("/user/my_projects/index.php?id=" . $_SESSION['user_id'])?>">Back</a>
  <div>
    <h1>CREATE PROJECT</h1>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for("/user/my_projects/new.php"); ?>" method="post">
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title"></dd>
      </dl>
      <dl>
        <dt>Category</dt>
        <dd><input type="text" name="category"></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><textarea type="text" name="description" > </textarea></dd>
      </dl>
      <div>
          <input type="submit" value="Create project" />
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>