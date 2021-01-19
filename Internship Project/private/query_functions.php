<?php  

    function find_all_projects(){
      global $db;

      $sql = "SELECT * FROM project";
      // $sql .= "ORDER BY position ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }
    
    function find_user_project($id){
      global $db;

      $sql = "SELECT * FROM project_member ";
      $sql .= "WHERE user_id='" . $id . "'";
      $result  = mysqli_query($db, $sql); 
      confirm_result_set($result);
      return $result;  //return assoc array
    }
    

    function find_project_by_id($id){
      global $db;
        
      $sql = "SELECT * FROM project ";
      $sql .= "WHERE id='" . $id . "'"; //prevent sql injection
      $result  = mysqli_query($db, $sql); 
      confirm_result_set($result);
      $subject = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $subject;  //return assoc array
    }

    function find_project_member_by_project_id($id){
      global $db;

      $sql = "SELECT * FROM project_member ";
      $sql .= "WHERE project_id='" . $id . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; //return only ids of user in that project
    }
    function find_project_member_by_user_id($id){
      global $db;

      $sql = "SELECT * FROM project_member ";
      $sql .= "WHERE user_id='" . $id . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; //return only ids of user in that project
    }
    function find_project_member_by_id($id){
      global $db;

      $sql = "SELECT * FROM project_member ";
      $sql .= "WHERE ID='" . $id . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result; //return only ids of user in that project
    }
    

    function validate_project($project){
      $errors = [];
      
      //title
      if(is_blank($project['title'])){
        $errors[] = "Title cannot be blank.";
      } elseif(!has_length($project['title'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Title must be between 2 and 255 characters.";
      }
      //category
      if(is_blank($project['category'])){
        $errors[] = "Category cannot be blank.";
      } elseif(!has_length($project['category'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Category must be between 2 and 255 characters.";
      }
      //description
      if(is_blank($project['description'])){
        $errors[] = "Description cannot be blank.";
      } elseif(!has_length($project['description'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Description must be between 2 and 255 characters.";
      }

      return $errors;
    }

    function validate_user($user){
      $errors = [];
      
      if(is_blank($user['name'])){
        $errors[] = "Name cannot be blank.";
      } elseif(!has_length($user['name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
      }
      if(is_blank($user['surname'])){
        $errors[] = "Surname cannot be blank.";
      } elseif(!has_length($user['surname'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Surname must be between 2 and 255 characters.";
      }
      if(is_blank($user['username'])){
        $errors[] = "Username cannot be blank.";
      } elseif(!has_length($user['username'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Username must be between 2 and 255 characters.";
      }
      if(!(has_unique_username($user['username']))){
        $errors[] = "This username is used, try another one.";    
      }

      if(is_blank($user['password'])){
        $errors[] = "Category cannot be blank.";
      } elseif(!has_length($user['password'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Category must be between 2 and 255 characters.";
      }

      return $errors;
    }

    function update_project($project){
      global $db;

      $errors = validate_project($project);
      if(!empty($errors)){
        return $errors;
      }

      $sql = "UPDATE project SET ";
      $sql .= "title='" .  $project['title'] . "',";
      $sql .= "category='" .  $project['category'] . "',";
      $sql .= "description='" .  $project['description'] . "' ";
      $sql .= "WHERE id='" . $project['ID']. "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
        //For UPDATE statements the result is boolean
        if(result){
            return true;
        }else{
          //Update Failed
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function find_all_users(){
      global $db;

      $sql = "SELECT * FROM user";
      // $sql .= "ORDER BY position ASC";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
    }

    function find_user_by_id($id){
      global $db;
        
      $sql = "SELECT * FROM user ";
      $sql .= "WHERE id='" . $id . "'"; //prevent sql injection
      $result  = mysqli_query($db, $sql); 
      confirm_result_set($result);
      $subject = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $subject;  //return assoc array
    }

    function insert_user($user){
      global $db;

      $errors = validate_user($user);
      if(!empty($errors)){
        return $errors;
      }

      $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

      $sql = "INSERT INTO user ";
      $sql .= "(name, surname, username, password, type)";
      $sql .= "VALUES (";
      $sql .="'" . $user['name'] . "',";
      $sql .="'" . $user['surname'] . "',";
      $sql .="'" . $user['username'] . "',";
      $sql .="'" . $hashed_password . "',";
      $sql .="'" . $user['type'] . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      if($result){
        return true;
      }else{
        //Failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    function delete_user($id){
      global $db;

      $sql = "DELETE FROM user ";
      $sql .= "WHERE id='" . $id . "' ";
      $sql .= "LIMIT 1";
    
      $result = mysqli_query($db, $sql);
    
      if($result){
        return true;
      }else{
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    function insert_project($project){
      global $db;

      $errors = validate_project($project);
      if(!empty($errors)){
        return $errors;
      }

      $errors = validate_project($project);
      $sql = "INSERT INTO project ";
      $sql .= "(title, category, submitted_date, description)";
      $sql .= "VALUES (";
      $sql .="'" . $project['title'] . "',";
      $sql .="'" . $project['category'] . "',";
      $sql .="now(),";
      $sql .="'" . $project['description'] . "'";
      $sql .= ")"; 

      
      $result = mysqli_query($db, $sql);
      if($result){
        return true;
      }else{
        //Failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    function insert_project_member($member){
      global $db;
      $sql = "INSERT INTO project_member ";
      $sql .= "(project_id, user_id, role)";
      $sql .= "VALUES (";
      $sql .= "'". $member['project_id'] . "',";
      $sql .= "'". $member['user_id'] . "',";
      $sql .= "'". $member['role'] . "'";
      $sql .= ")";

      $result = mysqli_query($db, $sql);
      if($result){
        return true;
      }else{
        //Failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    function delete_project($id){
      global $db;

      $sql = "DELETE FROM project ";
      $sql .= "WHERE id='" . $id . "' ";
      $sql .= "LIMIT 1";
    
      $result = mysqli_query($db, $sql);
    
      if($result){
        return true;
      }else{
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }
    function delete_member($id){
      global $db;

      $sql = "DELETE FROM project_member ";
      $sql .= "WHERE ID='" . $id . "' ";
      $sql .= "LIMIT 1";
    
      $result = mysqli_query($db, $sql);
    
      if($result){
        return true;
      }else{
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }

    function get_user_role($project_id, $user_id){
      global $db;

      $sql = "SELECT role FROM project_member ";
      $sql .= "WHERE project_id='" . $project_id . "' ";
      $sql .= "AND user_id='" . $user_id . "'";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $subject = mysqli_fetch_assoc($result);
      return $subject['role'];
    }

    
    function get_user_by_username($username){
      global $db;

      $sql = "SELECT * FROM user ";
      $sql .= "WHERE username='" . $username ."'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $subject = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $subject;
    }

?>