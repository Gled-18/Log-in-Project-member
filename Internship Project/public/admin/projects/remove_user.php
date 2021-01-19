<?php
  require_once('../../../private/initialize.php');
  session_start();
  require_login();

  $id = $_GET['id'];

  $m = find_project_member_by_id($id);
  $member = mysqli_fetch_assoc($m);
  if(is_post_request()){
    
    $page_id = $member['project_id'];
    $result = delete_member($member['ID']);
    // $member = find_project_member_by_user_id($id);
    // $array_result = mysqli_fetch_assoc($member);
    // $result = delete_member($array_result['user_id']);
    
    redirect_to(url_for('/admin/projects/show.php?id='. $page_id));
  }else{

    $user = find_user_by_id($member['user_id']);
  }

?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <a href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to main menu</a>
    
    <div>
      <h1>Delete User</h1>
      <p>Are you sure you want to delete this user?</p>
      <p><?php echo $user['name'] . " ". $user['surname']; ?></p>
      <form action="<?php echo url_for('/admin/projects/remove_user.php?id=' . $member['ID']); ?>" method="post">
        <div>
          <input type="submit" name="commit" value="Delete Member" />
        </div>
      </form>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>