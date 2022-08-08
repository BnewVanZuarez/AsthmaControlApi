<?php
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	global $global_base_url;
	global $global_upload_file;
	$data = array();
	$sql  = "
      SELECT
         `rencana_aksi_asma`.`id`,
         `rencana_aksi_asma`.`nama_dokter`,
         `rencana_aksi_asma`.`telp_dokter`,
         `rencana_aksi_asma`.`tanggal_input`
      FROM `rencana_aksi_asma`
      WHERE TRUE
		AND `rencana_aksi_asma`.`users_id`='".$parram['users_id']."'
	";
	$sql .= " ORDER BY `rencana_aksi_asma`.`tanggal_input` DESC LIMIT ".$parram['startpoint'].", ".$global_limit;
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	return $data;
}
function DaftarNumRows($parram){
	global $global_koneksi;
	$data = 0;
	$sql = "
		SELECT COUNT(`rencana_aksi_asma`.`id`) AS 'total' FROM `rencana_aksi_asma`
		WHERE TRUE
		AND `rencana_aksi_asma`.`users_id`='".$parram['users_id']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}
function Input($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `rencana_aksi_asma`
		SET
			`users_id`='".$parram['users_id']."',
			`nama_dokter`='".$parram['nama_dokter']."',
			`telp_dokter`='".$parram['telp_dokter']."',
			`kontak_darurat`='".$parram['kontak_darurat']."',
			`telp_darurat`='".$parram['telp_darurat']."',
			`nama_obat`='".$parram['nama_obat']."',
			`dosis_obat`='".$parram['dosis_obat']."',
			`digunakan_saat`='".$parram['digunakan_saat']."',
			`instruksi_tambahan`='".$parram['instruksi_tambahan']."',
			`pemicu`='".$parram['pemicu']."',
			`tanggal_input`='".$parram['tanggal_input']."'		 
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
function Update($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		UPDATE `rencana_aksi_asma`
		SET
			`hijau_peakflow_dari`='".$parram['hijau_peakflow_dari']."',
			`hijau_peakflow_ke`='".$parram['hijau_peakflow_ke']."',
			`kuning_peakflow_dari`='".$parram['kuning_peakflow_dari']."',
			`kuning_peakflow_ke`='".$parram['kuning_peakflow_ke']."',
			`merah_peakflow_dari`='".$parram['merah_peakflow_dari']."',
			`merah_peakflow_ke`='".$parram['merah_peakflow_ke']."' 
		WHERE `id`='".$parram['id']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
function InputObat($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "INSERT INTO `rencana_aksi_asma_obat`(`rencana_id`, `zona`, `jenis_obat`, `dosis`, `waktu_konsumsi`) VALUES ".$parram['values'];
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}