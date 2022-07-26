<?php
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	global $global_base_url;
	global $global_upload_file;
	$data = array();
	$sql  = "
      SELECT
         `peak_flow`.`id`,
         DATE_FORMAT(`peak_flow`.`tanggal`, '%d %b %Y') AS 'tanggal',
         `peak_flow`.`nilai`,
         `peak_flow`.`warna`,
         `peak_flow`.`tanggal_input`
      FROM `peak_flow`
      WHERE TRUE
		AND `peak_flow`.`users_id`='".$parram['users_id']."'
	";
	$sql .= " ORDER BY `peak_flow`.`tanggal_input` DESC LIMIT ".$parram['startpoint'].", ".$global_limit;
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
		SELECT COUNT(`peak_flow`.`id`) AS 'total' FROM `peak_flow`
		WHERE TRUE
		AND `peak_flow`.`users_id`='".$parram['users_id']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}