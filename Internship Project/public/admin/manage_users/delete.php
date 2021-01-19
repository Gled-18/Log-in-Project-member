<?php
  require_once('../../../private/initialize.php');
  session_start();
  require_login();

  $id = $_GET['id'];

  if(is_post_request()){
    $result = delete_user($id);
    redirect_to(url_for('/admin/manage_users/index.php'));
  }else{
    $user = find_user_by_id($id);
  }

?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <a href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to main menu</a>
    <a href="<?php echo url_for('/admin/manage_users/index.php'); ?>">&laquo; Back to Users</a>
    <div>
      <h1>Delete User</h1>
      <p>Are you sure you want to delete this user?</p>
      <p><?php echo $user['name'] . " ". $user['surname']; ?></p>
      <form action="<?php echo url_for('/admin/manage_users/delete.php?id=' . $user['ID']); ?>" method="post">
        <div>
          <input type="submit" name="commit" value="Delete User" />
        </div>
      </form>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>