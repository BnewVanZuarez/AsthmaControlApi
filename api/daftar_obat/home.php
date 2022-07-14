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

if ($post['aksi'] == "obat") {

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
         $obat_num_rows = 0;
         $obat_num_rows = DaftarNumRows(array('users_id' => $logindata['id']));
         $obat = Daftar(array('users_id' => $logindata['id'], 'startpoint' => $startpoint));
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
         'obat' => $obat,
         'obat_num_rows' => $obat_num_rows
		)
	));

}elseif ($post['aksi'] == "input_obat") {

   $login      = true;
   $hash       = (isset($post['hash']) ? $post['hash'] : "");
   $email      = (isset($post['email']) ? $post['email'] : "");
   $nama_obat  = (isset($post['nama_obat']) ? $post['nama_obat'] : "");
   $dosis      = (isset($post['dosis']) ? $post['dosis'] : "");

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
	   if ($nama_obat == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Nama Obat Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $nama_obat)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Nama Obat hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
	   }
	}

	if ($info['detail'] == "") {
	   if ($dosis == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Dosis Harian Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[a-zA-Z0-9\!\@\#\%\*\(\)\-\_\+\=\,\.\/\?\ ]*$/", "text" => $dosis)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Dosis Harian hanya boleh karakter : " . "\n" . "1) a sampai z" . "\n" . "2) A sampai Z" . "\n" . "3) 0 sampai 9" . "\n" . "4) ! @ # % * ( ) - _ + = , . / ? dan spasi";
	   }
	}

	if ($info['detail'] == "") {
		$logindata = loginWithHash(array('email' => $email, 'hash' => $hash));
      if (count($logindata) > 0) {
         $input = InputObat(
            array(
               'users_id' => Escape($logindata['id']),
               'nama_obat' => Escape($nama_obat),
               'dosis' => Escape($dosis),
               'tanggal_input' => date("Y-m-d H:i:s"),
            )
         );
         if ($input) {
            $info['error'] = "1";
            $info['detail'] = "Berhasil menyimpan Obat";
         } else {
            $info['error'] = "2";
            $info['detail'] = "Gagal menyimpan Obat, silahkan coba lagi !";
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
   
}