<?php 
  require_once('../private/initialize.php');
  session_start();
  $username = '';
  $password = '';
  $errors = null;
  if(is_post_request()){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(is_blank($username)){
      $errors[] = "Username is empty!";
    }
    if(is_blank($password)){
      $errors[] = "Password is empty";
    }

    if(empty($errors)){
      $user = get_user_by_username($username);
    if($user){
      if(password_verify($password, $user['password'])  ){
      // if($password === $user['password']){
        //password match
        log_in_user($user);
        if($user['type'] === "admin"){
          redirect_to(url_for('/admin/index.php'));
        }else{
          redirect_to(url_for('/user/index.php'));
        }
        
      }else{
        //username found but wrong pass
        $errors[] = "Log in was unsuccesful.";
      }

    }
    }else{
      //no username was found
      $errors[] = "Log in was unsuccesful.";
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Document</title>
</head>
<body>
  <h1>WELCOME</h1>
  <?php echo display_errors($errors);?>
  <form action="index.php" method="POST" id="my_form">
    <label>Name: </label><input type="text" name="username" id="usernames"><br/><br />
    <label>Password: </label><input type="password" name="password"><br /><br />
    <input type = "submit" value = " Submit "/><br />
  </form>
</body>

</html>

