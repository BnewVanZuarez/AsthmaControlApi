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

if ($post['aksi'] == "update_profil") {

   $login      = true;
   $hash       = (isset($post['hash']) ? $post['hash'] : "");
   $email      = (isset($post['email']) ? $post['email'] : "");
   $password   = (isset($post['password']) ? $post['password'] : "");
   $nama_lengkap = (isset($post['nama_lengkap']) ? $post['nama_lengkap'] : "");
   $no_telp    = (isset($post['no_telp']) ? $post['no_telp'] : "");

	if ($info['detail'] == "") {
	   if ($hash == "") {
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
	   if ($nama_lengkap == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Nama Lengkap Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $nama_lengkap)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Nama Lengkap hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
	   }
	}

	if ($info['detail'] == "") {
	   if ($no_telp == "") {
	      $info['error'] = "2";
	      $info['detail'] = "No. Telp Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $no_telp)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "No. Telp hanya boleh karakter : " . "\n" . "1) 0 sampai 9";
	   }
	}

	if ($info['detail'] == "") {
		$logindata = loginWithHash(array('email' => $email, 'hash' => $hash));
      if (count($logindata) > 0) {
         $input = UpdateProfil(
            array(
               'nama_lengkap' => Escape($nama_lengkap),
               'no_telp' => Escape($no_telp),
               'password' => ($password != "" ? password_hash($password, PASSWORD_DEFAULT) : ''),
               'id' => Escape($logindata['id']),
            )
         );
         if ($input) {
            $info['error'] = "1";
            $info['detail'] = "Berhasil menyimpan Perubahan";
         } else {
            $info['error'] = "2";
            $info['detail'] = "Gagal menyimpan Perubahan, silahkan coba lagi !";
         }
      }else {
			$login = false;
      }
	}

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info,
			'login_data' => $logindata,
			'login' => $login
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