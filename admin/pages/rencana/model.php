<?php
// List
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
      SELECT
         `rencana_aksi_asma`.`id`,
         `rencana_aksi_asma`.`users_id`,
         `users`.`nama_lengkap`,
         `rencana_aksi_asma`.`nama_dokter`,
         `rencana_aksi_asma`.`telp_dokter`,
         `rencana_aksi_asma`.`kontak_darurat`,
         `rencana_aksi_asma`.`telp_darurat`,
         `rencana_aksi_asma`.`nama_obat`,
         `rencana_aksi_asma`.`tanggal_input`
      FROM `rencana_aksi_asma`
      INNER JOIN `users` ON `rencana_aksi_asma`.`users_id`=`users`.`id`
      WHERE TRUE
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
      INNER JOIN `users` ON `rencana_aksi_asma`.`users_id`=`users`.`id`
		WHERE TRUE
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}
// List End