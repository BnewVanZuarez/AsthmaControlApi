<?php
//jika tidak diberi ini, maka akan error di app android
header('Content-Type: application/json;charset=utf-8');
//koneksi database
include("../../libs/api.php");
include("../../libs/config.php");
include("../../libs/funct.php");
include("../../libs/model.php");
include("model.php");

$post = json_decode(preg_replace('/\R+/', '', file_get_contents('php://input')), true);
$info = array(
	'error' => "1",
	'detail' => "",
	'link' => ""
);
$logindata = array(
	'id' => "",
	'email' => "",
	'password' => "",
	'nama_lengkap' => "",
	'no_telp' => "",
	'level' => "",
	'status' => ""
);

if ($post['aksi'] == "cek_login") {

   $login = true;
   $greeting = "Error !";
	$logindata = array();
   $hash 	= (isset($post['hash']) ? $post['hash'] : "");
   $email	= (isset($post['email']) ? $post['email'] : "");


	if ($info['detail'] == "") {
	   if ($hash == "") {
			$login = false;
	      $info['error'] = "2";
	      $info['detail'] = "Hash Tidak Boleh Kosong";
	   }
	}

	if ($info['detail'] == "") {
	   if ($email == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Email Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\@\.\-\_]*$/", "text" => $email)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Email Hanya Boleh Menggunakan Karakter: 1) a sampai z 2) A sampai Z 3) 0 sampai 9 4) @. - _";
	   }
	}

	if ($info['detail'] == "") {
		$logindata = loginWithHash(array('email' => $email, 'hash' => $hash));
      if (count($logindata) > 0) {
			$login = true;
			$greeting = Ucapan();
      }else {
			$login = false;
      }
	}

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info,
			'login' => $login,
			'login_data' => $logindata,
			'greeting' => $greeting,
			'edukasi' => Edukasi(),
		)
	));

}else {
	
	$info = array(
		'error' => "2",
		'detail' => "Error Aksi !",
		'link' => ""
	);

	$hash = "";

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info,
			'hash' => $hash
		)
	));

}