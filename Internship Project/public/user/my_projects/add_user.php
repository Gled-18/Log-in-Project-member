<?php
  require_once('../../../private/initialize.php');
  session_start();
  require_login();
  $my_errors = null;
  if(is_post_request()){
    $username = $_POST['username'];
    $user = get_user_by_username($username);

      $member = [];
      $member['project_id'] = $_SESSION['project_id'];
      $member['user_id'] = $user['ID'];
      $member['role'] = $_POST['role'];

      $result = insert_project_member($member);
      if($result === true){
        redirect_to(url_for('/user/my_projects/show.php?id=' . $_SESSION['project_id']));
      }
    
    
  }else{
    $member = [];
    $member['project_id'] = '';
    $member['user_id'] = '';
    $member['role'] = '';
  }

  $user_set = find_all_users();
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
  <a href="<?php echo url_for('/user/my_projects/show.php?id='. $_SESSION['project_id']) ?>">Back</a>
  <div>
    <h1>Add member to project</h1>
    <?php echo display_errors($my_errors); ?>
    <form action="<?php echo url_for('/user/my_projects/add_user.php?id=' . $member['project_id']); ?>" method="post">
      <label>Username </label>
      <select name="username">
        <?php while($users = mysqli_fetch_assoc($user_set)){ ?>
        <?php $username = $users['username'];?>
          <option ><?php echo $users['username']; ?></option>
        <?php }?>
      </select>
       <br>
      <label>Role</label> 
        <select name="role">
        <option value="manager">Manager</option>
        <option value="tester">Tester</option>
        <option value="developer">Developer</option>
        </select><br>
        <input type="submit" value="Add" />
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>