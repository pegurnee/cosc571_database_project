<?php 
  $user_status = array(
      'admin'=>'admin',
      'user'=>'user'
  );
 
  $project_root = explode('/', $_SERVER['SCRIPT_NAME'])[0];
  if (strlen($project_root)) {
    $project_root.="/";
  }
  
  $admin_root = $project_root."admin/";
  
  $locations = array(
      'main_style'=> $admin_root.'css/styles.css',
      'home'=> $project_root
  );
?>