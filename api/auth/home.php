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

if ($post['aksi'] == "login") {

   $hash = "";
   $email 	 = (isset($post['email']) ? $post['email'] : "");
   $password = (isset($post['password']) ? $post['password'] : "");

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
		if ($password == "") {
	      $info['error'] = "2";
			$info['detail'] = "Password Tidak Boleh Kosong";
		}
	}

	if ($info['detail'] == "") {
		$cek_login = Login(array('email' => $email));
      if (count($cek_login) > 0) {

			if ($cek_login['level'] == 3) {

				if (password_verify($password, $cek_login['password'])) { //Cek Password
					$hash = md5(rand(100000, 9999999));
					$upd_hash = UpdateHash(array('email' => Escape($email), 'hash' => Escape($hash)));
					if (!$upd_hash) {
                  $info['error'] = "2";
						$info['detail'] = "Terjadi kesalahan, silahkan coba lagi !";
					}
	
				}else {
               $info['error'] = "2";
					$info['detail'] = "Password yang anda masukkan salah atau tidak cocok, silahkan coba lagi !";
				}
				
			}else {
            $info['error'] = "2";
            $info['detail'] = "Anda tidak diizinkan menggunakan aplikasi, silahkan hubungi admin !";
			}

      }else {
	      $info['error'] = "2";
			$info['detail'] = "Email yang anda masukkan salah atau tidak cocok, silahkan coba lagi !";
      }
	}

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info,
			'hash' => $hash
		)
	));
   
}elseif ($post['aksi'] == "lupa") {
   
   $email = (isset($post['email']) ? $post['email'] : "");

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
		$cek_login = Login(array('email' => $email));
      if (count($cek_login) > 0) {
			$token = rand(0000, 9999);
			$hash = $token;
			$upd_hash = UpdateReset(array('email' => Escape($email), 'reset' => $hash));
			// SendMail(
			// 	array(
			// 		'kepada' => $email,
			// 		'judul' => "Kode Keamanan Reset Password",
			// 		'pesan' => EmailTemplate(
			// 			array(
			// 				'judul' => "Kode Keamanan Reset Password",
			// 				'isi' => $hash,
			// 			)
			// 		),
			// 	)
			// );
			if (!$upd_hash) {
            $info['error'] = "2";
				$info['detail'] = "Terjadi kesalahan, silahkan coba lagi !";
			}

      }else {
	      $info['error'] = "2";
			$info['detail'] = "Email tidak ditemukan, silahkan coba lagi !";
      }
	}

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info,
			'hash' => $hash,
			'token' => $token
		)
	));

}elseif ($post['aksi'] == "reset_password") {
   
   $kode 		= (isset($post['kode']) ? $post['kode'] : "");
   $password 	= (isset($post['password']) ? $post['password'] : "");
   $konfirmasi = (isset($post['konfirmasi']) ? $post['konfirmasi'] : "");

	if ($info['detail'] == "") {
	   if ($kode == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Kode OTP Tidak Boleh Kosong";
	   }
	}

	if ($info['detail'] == "") {
	   if ($password == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Password Tidak Boleh Kosong";
	   }
	}

	if ($info['detail'] == "") {
	   if ($konfirmasi == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Konfirmasi Password Tidak Boleh Kosong";
	   }
	}

	if ($info['detail'] == "") {
	   if ($password != $konfirmasi) {
	      $info['error'] = "2";
	      $info['detail'] = "Password Tidak Cocok";
	   }
	}

	if ($info['detail'] == "") {
		$cek_login = CekOtp(array('reset' => $kode));
      if (count($cek_login) > 0) {

			$upd_hash = UpdatePassword(
				array(
					'email' => Escape($cek_login['email']),
					'password' => password_hash($konfirmasi, PASSWORD_DEFAULT)
				)
			);
			if (!$upd_hash) {
            $info['error'] = "2";
				$info['detail'] = "Terjadi kesalahan, silahkan coba lagi !";
			}

      }else {
	      $info['error'] = "2";
			$info['detail'] = "Kode OTP Tidak valid, silahkan coba lagi !";
      }
	}

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info,
			'data' => $upd_hash
		)
	));

}elseif ($post['aksi'] == "register") {
   
   $email 		= (isset($post['email']) ? $post['email'] : "");
   $password 	= (isset($post['password']) ? $post['password'] : "");
   $nama 		= (isset($post['nama']) ? $post['nama'] : "");
   $no_telp		= (isset($post['no_telp']) ? $post['no_telp'] : "");
   $level		= (isset($post['level']) ? $post['level'] : "");

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
	   if ($password == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Password Tidak Boleh Kosong";
	   }
	}

	if ($info['detail'] == "") {
	   if ($nama == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Nama Lengkap Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $nama)) ) {
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
	   if ($level == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Level Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $level)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Level hanya boleh karakter : " . "\n" . "1) 0 sampai 9";
	   }
	}

	if ($info['detail'] == "") {
		$insert = InputRegister(
			array(
				'email' => Escape($email),
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'nama' => Escape($nama),
				'no_telp' => Escape($no_telp),
				'level' => Escape($level),
				'aktif' => "1",
				'tanggal_input' => date("Y-m-d H:i:s")
			)
		);
		if (!$insert) {
	      $info['error'] = "2";
			$info['detail'] = "Gagal melakukan pendaftaran, silahkan coba lagi!";
		}
	}

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info
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