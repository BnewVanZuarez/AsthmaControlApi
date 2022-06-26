<?php
include("../libs/api.php");
include("../libs/config.php");
include("../libs/funct.php");
include("../libs/model.php");
include("../libs/pagging.php");

$get  		= $_GET;
$post 		= $_POST;
$session 	= $_SESSION;
$files 		= $_FILES;

if (isset($session) && isset($session['auth']) && isset($session['auth']['email']) ) {
	$login = loginWithHash(array('email' => $session['auth']['email'], 'hash' => $session['auth']['hash']));
	if (count($login) > 0) {
		switch (isset($get['pages']) ? $get['pages'] : '') {
			case 'home':
				include("pages/home/home.php");
				break;
			case 'edukasi':
				include("pages/edukasi/home.php");
				break;
			case 'rumahsakit':
				include("pages/rumahsakit/home.php");
				break;
			case 'users':
				include("pages/users/home.php");
				break;
			case 'logout':
				include("pages/auth/logout.php");
				break;
			default:
				include("pages/home/home.php");
				break;
		}
	}else{
		include("pages/auth/logout.php");
	}
}else{
   switch (isset($get['pages']) ? $get['pages'] : '') {
      case 'auth':
         include("pages/auth/home.php");
         break;
      default:
         include("pages/auth/home.php");
         break;
   }
}