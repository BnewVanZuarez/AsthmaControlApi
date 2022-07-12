<?php
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	global $global_base_url;
	global $global_upload_file;
	$data = array();
	$sql  = "
      SELECT
         `daftar_obat`.`id`,
         `daftar_obat`.`users_id`,
         `daftar_obat`.`nama_obat`,
         `daftar_obat`.`dosis`,
         `daftar_obat`.`tanggal_input`
      FROM `daftar_obat`
      WHERE TRUE
	";
	$sql .= " ORDER BY `daftar_obat`.`tanggal_input` DESC LIMIT ".$parram['startpoint'].", ".$global_limit;
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
		SELECT COUNT(`daftar_obat`.`id`) AS 'total' FROM `daftar_obat`
		WHERE TRUE
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}
function InputObat($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `daftar_obat`
		SET 
         `users_id`='".$parram['users_id']."',
         `nama_obat`='".$parram['nama_obat']."',
         `dosis`='".$parram['dosis']."',
         `tanggal_input`='".$parram['tanggal_input']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}