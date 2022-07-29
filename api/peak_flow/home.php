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

if ($post['aksi'] == "peak_flow") {

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
         $peakflow_num_rows = 0;
         $peakflow_num_rows = DaftarNumRows(array('users_id' => $logindata['id']));
         $peakflow = Daftar(array('users_id' => $logindata['id'], 'startpoint' => $startpoint));
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
         'peakflow' => $peakflow,
         'peakflow_num_rows' => $peakflow_num_rows
		)
	));

}elseif ($post['aksi'] == "input_peak_flow") {

   $login      = true;
   $hash       = (isset($post['hash']) ? $post['hash'] : "");
   $email      = (isset($post['email']) ? $post['email'] : "");

   $tanggal    = (isset($post['tanggal']) ? $post['tanggal'] : date("Y-m-d"));
   $nilai      = (isset($post['nilai']) ? $post['nilai'] : "");
   $warna      = (isset($post['warna']) ? $post['warna'] : "");

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
	   if ($tanggal == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Tanggal Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9\-]*$/", "text" => $tanggal)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Tanggal Hanya Boleh Menggunakan Karakter: 1) A sampai Z 2) - ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($nilai == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Nilai Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $nilai)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Nilai Hanya Boleh Menggunakan Karakter: 1) A sampai Z ";
	   }
	}

	if ($info['detail'] == "") {
	   if ($warna == "") {
	      $info['error'] = "2";
	      $info['detail'] = "Warna Tidak Boleh Kosong";
	   }elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $warna)) ) {
	      $info['error'] = "2";
	      $info['detail'] = "Warna Hanya Boleh Menggunakan Karakter: 1) A sampai Z ";
	   }
	}

	if ($info['detail'] == "") {
		$logindata = loginWithHash(array('email' => $email, 'hash' => $hash));
      if (count($logindata) > 0) {
         $input = Input(
            array(
               'users_id' => Escape($logindata['id']),
               'tanggal' => Escape($tanggal),
               'nilai' => Escape($nilai),
               'warna' => Escape($warna),
               'tanggal_input' => date("Y-m-d H:i:s"),
            )
         );
         if ($input) {
            $info['error'] = "1";
            $info['detail'] = "Berhasil menyimpan Data Peak Flow";
         } else {
            $info['error'] = "2";
            $info['detail'] = "Gagal menyimpan Data Peak Flow, silahkan coba lagi !";
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