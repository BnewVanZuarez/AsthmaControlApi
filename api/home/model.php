<?php
function Edukasi(){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
		SELECT
			`edukasi`.`id`,
			`edukasi`.`slug`,
			`edukasi`.`writer`,
			`edukasi`.`judul`,
			`edukasi`.`gambar`,
			`edukasi`.`video`,
			`edukasi`.`tanggal_input`
		FROM `edukasi`
		WHERE TRUE
	";
	$sql .= " ORDER BY `edukasi`.`tanggal_input` DESC LIMIT 6 ";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	return $data;
}