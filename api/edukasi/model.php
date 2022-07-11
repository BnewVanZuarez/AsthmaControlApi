<?php
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	global $global_base_url;
	global $global_upload_file;
	$data = array();
	$sql  = "
      SELECT
         `edukasi`.`id`,
         `edukasi`.`slug`,
         `edukasi`.`writer`,
         `edukasi`.`judul`,
         #`edukasi`.`gambar`,
         CONCAT('".$global_base_url.$global_upload_file."edukasi/thumb/', `edukasi`.`gambar`) AS 'gambar',
         `edukasi`.`video`,
         `edukasi`.`tanggal_input`
      FROM `edukasi`
      WHERE TRUE
	";
	$sql .= " ORDER BY `edukasi`.`tanggal_input` DESC LIMIT ".$parram['startpoint'].", ".$global_limit;
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
		SELECT COUNT(`edukasi`.`id`) AS 'total' FROM `edukasi`
		WHERE TRUE
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}