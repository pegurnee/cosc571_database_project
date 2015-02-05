<?php
  include_once 'admin/php/constants.php';
  include_once 'admin/php/common.php';
  include_once 'admin/php/displays.php';
  include_once 'admin/php/profile.php';
  include_once 'admin/php/us_state_dropdown.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('Register')?>
  <body>
    <div id="container">
      <?=createHeader(true, false)?>
      <div class="content">
        <div id="login" class="centered box">
          <?=createProfileForm()?>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
