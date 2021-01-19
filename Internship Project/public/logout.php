<?php
require_once('../private/initialize.php');
   log_out_user();
   session_destroy();
   redirect_to(url_for('index.php'));
?>
  
