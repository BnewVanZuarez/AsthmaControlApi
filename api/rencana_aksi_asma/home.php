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

if ($post['aksi'] == "rencana_aksi_asma") {

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
         $rencana_num_rows = 0;
         $rencana_num_rows = DaftarNumRows(array('users_id' => $logindata['id']));
         $rencana = Daftar(array('users_id' => $logindata['id'], 'startpoint' => $startpoint));
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
         'rencana' => $rencana,
         'rencana_num_rows' => $rencana_num_rows
		)
	));

}elseif ($post['aksi'] == "buat_rencana") {

   $login      = true;
   $hash       = (isset($post['hash']) ? $post['hash'] : "");
   $email      = (isset($post['email']) ? $post['email'] : "");
	
   $nama_dokter 	= (isset($post['nama_dokter']) ? $post['nama_dokter'] : "");
   $telp_dokter 	= (isset($post['telp_dokter']) ? $post['telp_dokter'] : "");
   $kontak_darurat= (isset($post['kontak_darurat']) ? $post['kontak_darurat'] : "");
   $telp_darurat 	= (isset($post['telp_darurat']) ? $post['telp_darurat'] : "");
   $nama_obat 		= (isset($post['nama_obat']) ? $post['nama_obat'] : "");
   $dosis_obat 	= (isset($post['dosis_obat']) ? $post['dosis_obat'] : "");
   $digunakan_saat= (isset($post['digunakan_saat']) ? $post['digunakan_saat'] : "");
   $instruksi_tambahan 	= (isset($post['instruksi_tambahan']) ? $post['instruksi_tambahan'] : "");
   $pemicu 			= (isset($post['pemicu']) ? $post['pemicu'] : "");

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
         $input = Input(
            array(
               'users_id' => Escape($logindata['id']),
               'nama_dokter' => Escape($nama_dokter),
               'telp_dokter' => Escape($telp_dokter),
               'kontak_darurat' => Escape($kontak_darurat),
               'telp_darurat' => Escape($telp_darurat),
               'nama_obat' => Escape($nama_obat),
               'dosis_obat' => Escape($dosis_obat),
               'digunakan_saat' => Escape($digunakan_saat),
               'instruksi_tambahan' => Escape($instruksi_tambahan),
               'pemicu' => Escape($pemicu),
               'tanggal_input' => date("Y-m-d H:i:s"),
            )
         );
         if ($input) {
            $last_id = mysqli_insert_id($global_koneksi);
            $info['error'] = "1";
            $info['detail'] = "Berhasil menyimpan Data Rencana Aksi Asma";
         } else {
            $info['error'] = "2";
            $info['detail'] = "Gagal menyimpan Data Rencana Aksi Asma, silahkan coba lagi !";
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
			'login' => $login,
			'rencana_id' => $last_id
		)
	));

}elseif ($post['aksi'] == "update_rencana") {

   $login      = true;
   $hash       = (isset($post['hash']) ? $post['hash'] : "");
   $email      = (isset($post['email']) ? $post['email'] : "");
   $rencana_id = (isset($post['rencana_id']) ? $post['rencana_id'] : "");
   $hijau_peakflow_dari = (isset($post['hijau_peakflow_dari']) ? $post['hijau_peakflow_dari'] : "");
   $hijau_peakflow_ke 	= (isset($post['hijau_peakflow_ke']) ? $post['hijau_peakflow_ke'] : "");
   $kuning_peakflow_dari= (isset($post['kuning_peakflow_dari']) ? $post['kuning_peakflow_dari'] : "");
   $kuning_peakflow_ke 	= (isset($post['kuning_peakflow_ke']) ? $post['kuning_peakflow_ke'] : "");
   $merah_peakflow_dari = (isset($post['merah_peakflow_dari']) ? $post['merah_peakflow_dari'] : "");
   $merah_peakflow_ke 	= (isset($post['merah_peakflow_ke']) ? $post['merah_peakflow_ke'] : "");
   $data_obat_hijau 		= (isset($post['data_obat_hijau']) ? $post['data_obat_hijau'] : "");
   $data_obat_kuning 	= (isset($post['data_obat_kuning']) ? $post['data_obat_kuning'] : "");
   $data_obat_merah 		= (isset($post['data_obat_merah']) ? $post['data_obat_merah'] : "");

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
		$sql = "";	
		if ($data_obat_hijau != "") {
			$no  = 0;
			$arrhijau= json_decode($data_obat_hijau, true);
			foreach ($arrhijau as $value) {
				if ($no > 0) {
					$sql .= " , ";
				}
				$sql .= " ('".$rencana_id."','3','".$value['data_jenis']."','".$value['data_dosis']."','".$value['data_waktu']."') ";
				$no++;
			}
		}
		if ($data_obat_kuning != "") {
			if ($data_obat_hijau != "") {
				$sql .= " , ";
			}
			$no  = 0;
			$arrkuning= json_decode($data_obat_kuning, true);
			foreach ($arrkuning as $value2) {
				if ($no > 0) {
					$sql .= " , ";
				}
				$sql .= " ('".$rencana_id."','2','".$value2['data_jenis']."','".$value2['data_dosis']."','".$value2['data_waktu']."') ";
				$no++;
			}
		}
		if ($data_obat_merah != "") {
			if ($data_obat_kuning != "") {
				$sql .= " , ";
			}
			$no  = 0;
			$arrmerah= json_decode($data_obat_merah, true);
			foreach ($arrmerah as $value3) {
				if ($no > 0) {
					$sql .= " , ";
				}
				$sql .= " ('".$rencana_id."','1','".$value3['data_jenis']."','".$value3['data_dosis']."','".$value3['data_waktu']."') ";
				$no++;
			}
		}
	}

	if ($info['detail'] == "") {
		$logindata = loginWithHash(array('email' => $email, 'hash' => $hash));
      if (count($logindata) > 0) {
         $input = Update(
            array(
               'users_id' => Escape($logindata['id']),
               'hijau_peakflow_dari' => Escape($hijau_peakflow_dari),
               'hijau_peakflow_ke' => Escape($hijau_peakflow_ke),
               'kuning_peakflow_dari' => Escape($kuning_peakflow_dari),
               'kuning_peakflow_ke' => Escape($kuning_peakflow_ke),
               'merah_peakflow_dari' => Escape($merah_peakflow_dari),
               'merah_peakflow_ke' => Escape($merah_peakflow_ke),
               'id' => Escape($rencana_id),
            )
         );

         if ($input) {
				$obat = InputObat(array('values' => $sql));
				if ($obat) {
					$info['error'] = "1";
					$info['detail'] = "Berhasil menyimpan Data Rencana Aksi Asma";
				}else {
					$info['error'] = "2";
					$info['detail'] = "Gagal menyimpan Data Rencana Aksi Asma, silahkan coba lagi ! [2]";
				}
         } else {
            $info['error'] = "2";
            $info['detail'] = "Gagal menyimpan Data Rencana Aksi Asma, silahkan coba lagi !";
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
			'login' => $login,
			'rencana_id' => $rencana_id,
			'sql' => $sql
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