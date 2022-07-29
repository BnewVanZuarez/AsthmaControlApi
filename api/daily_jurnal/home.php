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

if ($post['aksi'] == "daily_jurnal") {

   $login      = true;
   $hash       = (isset($post['hash']) ? $post['hash'] : "");
   $email      = (isset($post['email']) ? $post['email'] : "");
   $startpoint = (isset($post['startpoint']) ? $post['startpoint'] : 0);

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
		$logindata = loginWithHash(array('email' => $email, 'hash' => $hash));
      if (count($logindata) > 0) {
			$login = true;
         $daily_num_rows = 0;
         $daily_num_rows = DaftarNumRows(array('users_id' => $logindata['id']));
         $daily = Daftar(array('users_id' => $logindata['id'], 'startpoint' => $startpoint));
      }else {
			$login = false;
      }
	}

	echo json_encode(array(
		'status' => true,
		'data' => array(
			'info' => $info,
			'login_data' => $logindata,
			'login' => $login,
         'daily' => $daily,
         'daily_num_rows' => $daily_num_rows
		)
	));

}elseif ($post['aksi'] == "input_daily") {

   $login      = true;
   $hash       = (isset($post['hash']) ? $post['hash'] : "");
   $email      = (isset($post['email']) ? $post['email'] : "");

   $tanggal    = (isset($post['tanggal']) ? $post['tanggal'] : date("Y-m-d"));
   $rate_today = (isset($post['rate_today']) ? $post['rate_today'] : "");
   $rate_pain  = (isset($post['rate_pain']) ? $post['rate_pain'] : "");
   $mood_today = (isset($post['mood_today']) ? $post['mood_today'] : "");
   $gejala     = (isset($post['gejala']) ? $post['gejala'] : "");
   $gejala_value  = (isset($post['gejala_value']) ? $post['gejala_value'] : "");
   $paparan       = (isset($post['paparan']) ? $post['paparan'] : "");
   $paparan_alergen  = (isset($post['paparan_alergen']) ? $post['paparan_alergen'] : "");
   $nafsu_makan      = (isset($post['nafsu_makan']) ? $post['nafsu_makan'] : "");
   $kelelahan     = (isset($post['kelelahan']) ? $post['kelelahan'] : "");
   $aktivitas     = (isset($post['aktivitas']) ? $post['aktivitas'] : "");
   $aktivitas_durasi = (isset($post['aktivitas_durasi']) ? $post['aktivitas_durasi'] : "");
   $aktivitas_intensitas = (isset($post['aktivitas_intensitas']) ? $post['aktivitas_intensitas'] : "");
   $notes = (isset($post['notes']) ? $post['notes'] : "");

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
	   if ($rate_today == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Penilaian hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $rate_today)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Penilaian hari ini Hanya Boleh Menggunakan Karakter: 1) 0 sampai 9 ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($rate_pain == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Tingkat rasa sakit hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $rate_pain)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Tingkat rasa sakit hari ini Hanya Boleh Menggunakan Karakter: 1) 0 sampai 9 ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($mood_today == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Mood hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $mood_today)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Mood hari ini Hanya Boleh Menggunakan Karakter: 1) 0 sampai 9 ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($gejala == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Gejala hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9]*$/", "text" => $gejala)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Gejala hari ini Hanya Boleh Menggunakan Karakter: " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9";
	   }
	}

	if ($info['detail'] == "") {
	   if ($gejala_value != "") {
			if (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $gejala_value)) ) {
				$info['error'] = "2";
				$info['detail'] = "Gejala hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
			}
	   }
	}

	if ($info['detail'] == "") {
	   if ($paparan == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Paparan hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9]*$/", "text" => $paparan)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Paparan hari ini Hanya Boleh Menggunakan Karakter: " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9";
	   }
	}

	if ($info['detail'] == "") {
	   if ($paparan_alergen != "") {
			if (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $paparan_alergen)) ) {
				$info['error'] = "2";
				$info['detail'] = "Paparan Alergen hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
			}
	   }
	}

	if ($info['detail'] == "") {
	   if ($nafsu_makan == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Nafsu makan hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $nafsu_makan)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Nafsu makan hari ini Hanya Boleh Menggunakan Karakter: 1) 0 sampai 9 ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($kelelahan == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Kelelahan hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $kelelahan)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Kelelahan hari ini Hanya Boleh Menggunakan Karakter: 1) 0 sampai 9 ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($aktivitas == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Aktivitas Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $aktivitas)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Aktivitas hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
	   }
	}

	if ($info['detail'] == "") {
	   if ($aktivitas_durasi == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Durasi Aktivitas hari ini Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $aktivitas_durasi)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Durasi Aktivitas hari ini Hanya Boleh Menggunakan Karakter: 1) 0 sampai 9 ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($aktivitas_intensitas == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Intensitas aktivitas Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9]*$/", "text" => $aktivitas_intensitas)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Intensitas aktivitas Hanya Boleh Menggunakan Karakter: " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9";
	   }
	}

	if ($info['detail'] == "") {
	   if ($notes == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Catatan/Komentar Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $notes)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Catatan/Komentar hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
	   }
	}

	if ($info['detail'] == "") {
		$logindata = loginWithHash(array('email' => $email, 'hash' => $hash));
      if (count($logindata) > 0) {
         $input = Input(
            array(
               'users_id' => Escape($logindata['id']),
               'tanggal' => Escape($tanggal),
               'rate_today' => Escape($rate_today),
               'rate_pain' => Escape($rate_pain),
               'mood_today' => Escape($mood_today),
               'gejala' => Escape($gejala),
               'gejala_value' => Escape($gejala_value),
               'paparan' => Escape($paparan),
               'paparan_alergen' => Escape($paparan_alergen),
               'nafsu_makan' => Escape($nafsu_makan),
               'kelelahan' => Escape($kelelahan),
               'aktivitas' => Escape($aktivitas),
               'aktivitas_durasi' => Escape($aktivitas_durasi),
               'aktivitas_intensitas' => Escape($aktivitas_intensitas),
               'notes' => Escape($notes),
               'tanggal_input' => date("Y-m-d H:i:s"),
            )
         );
         if ($input) {
            $info['error'] = "1";
            $info['detail'] = "Berhasil menyimpan Daily Jurnal";
         } else {
            $info['error'] = "2";
            $info['detail'] = "Gagal menyimpan Daily Jurnal, silahkan coba lagi !";
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