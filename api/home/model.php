<?php
function Edukasi(){
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
	$sql .= " ORDER BY `edukasi`.`tanggal_input` DESC LIMIT 6 ";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	return $data;
}