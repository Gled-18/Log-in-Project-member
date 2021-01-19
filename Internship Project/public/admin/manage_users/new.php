
<?php   
  require_once('../../../private/initialize.php');
  session_start();
  require_login();

  $errors = null;
  
  if(is_post_request()){
    //Handle from values sent by new php
    $user = [];
    $user['name'] = $_POST['name'];
    $user['surname'] = $_POST['surname'];
    $user['username'] = $_POST['username'];
    $user['password'] = $_POST['password'];
    $user['type'] = $_POST['type'];

    $result = insert_user($user);
    if($result === true){
      
      $new_id = mysqli_insert_id($db);
      redirect_to(url_for('/admin/manage_users/show.php?id=' . $new_id));
    }else{
      $errors = $result;
    }
  }else{
    $user = [];
    $user['name'] = "";
    $user['surname'] = "";
    $user['username'] = "";
    $user['password'] = "";
    $user['type'] = "";
  }

?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div>
    <a href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to main menu</a>
    <a href="<?php echo url_for('/admin/manage_users/index.php'); ?>">&laquo; Back to Users</a>
    <div>
      <h1>Create User</h1>
      <?php echo display_errors($errors)?>
      <form action="<?php echo url_for('/admin/manage_users/new.php'); ?>" method="post">
        <label>Name: </label> <input type="text" name="name"><br>
        <label>Surname: </label> <input type="text" name="surname"><br>
        <label>Username: </label> <input type="text" name="username"><br>
        <label>Password: </label> <input type="password" name="password"><br>
        <label>Type</label> 
        <select name="type">
        <option value="admin">Admin</option>
        <option value="simple">User</option>
        </select><br>
        <input type="submit" value="Create User" />
      </form>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>