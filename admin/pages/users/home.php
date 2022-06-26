<?php
include("model.php");
switch (isset($get['sub_page']) ? $get['sub_page'] : '') {
   case 'ajax':
      include("ajax.php");
      break;
   case 'depan':
      include("depan.php");
      break;
   default :
      include("depan.php");
      break;
}