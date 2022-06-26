<?php
include("model.php");
switch (isset($get['sub_page']) ? $get['sub_page'] : '') {
   case 'login':
      include("login.php");
      break;
   default :
      include("login.php");
      break;
}