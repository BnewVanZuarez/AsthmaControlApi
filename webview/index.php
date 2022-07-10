<?php
include("../libs/config.php");
include("../libs/model.php");
include("../libs/funct.php");
include("../libs/api.php");
include("../libs/pagging.php");

$get  		= $_GET;
$post 		= $_POST;
$session 	= $_SESSION;
$files 		= $_FILES;

switch (isset($get['pages']) ? $get['pages'] : '') {
   case 'edukasi':
      include("pages/edukasi/home.php");
      break;
   default:
      include("pages/edukasi/home.php");
      break;
}