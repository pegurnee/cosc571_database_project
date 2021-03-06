<?php
$user_status = array(
  'admin' => 'admin',
  'user' => 'user'
);

$name = array(
  //'long' => 'Best-Buy-Books',
  //'short' => '3-B'
  //'long' => 'Titan Entertainment',
  //'short' => 'T &and; E'
  //'long' => 'Power Cosmic ',
  //'short' => 'P &#8757; C',
  'long' => 'Theoretical Education',
  'short' => '&asymp; edu',
  'slogan' => "It's education... in theory."
);

$project_root_parts = explode('/', $_SERVER['SCRIPT_NAME']);
$project_root = $project_root_parts[1] . '/'
                . ((substr($project_root_parts[2], -4) == '.php'
                    || $project_root_parts[2] == 'admin') ?
                  '' : $project_root_parts[2] . '/');

$project_root = $_SERVER['REQUEST_SCHEME'] . '://'
                  . $_SERVER['SERVER_NAME'] . '/'
                      . $project_root;

$admin_root = $project_root . "admin/";

$locations = array(
  'styles' => $admin_root . 'css/',
  'main_style' => $admin_root . 'css/styles.css',
  'scripts' => $admin_root . 'js/',
  'lib' => $admin_root . 'lib/',
  'home' => $project_root . 'index.php',
  'cart' => $project_root . 'cart.php',
  'checkout' => $project_root . 'checkout.php',
  'profile' => $project_root . 'update_profile.php',
  'admin' => $project_root . 'admin.php',
  'register' => $project_root . 'register.php',
  'login' => $project_root . 'login.php',
  'logout' => $admin_root . 'php/logout.php',
  'search' => $project_root . 'search.php',
  'images' => $admin_root . 'images/',
  'covers' => $admin_root . 'images/covers/',
  'random_covers' => $admin_root . 'images/covers/random/',
  //'favicon' => $admin_root . 'images/icons/te_favicon.ico'
  //'favicon' => $admin_root . 'images/icons/t_e_favicon.ico'
  'favicon' => $admin_root . 'images/icons/not_omega_oval.ico'
  //'favicon' => $admin_root . 'images/icons/b3_favicon.ico'
);
?>
