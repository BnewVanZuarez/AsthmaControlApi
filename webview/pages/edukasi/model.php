<?php
function Detail($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
      SELECT
         `edukasi`.`id`,
         `edukasi`.`slug`,
         `edukasi`.`writer`,
         `edukasi`.`judul`,
         `edukasi`.`gambar`,
         `edukasi`.`video`,
         `edukasi`.`detail`,
         `edukasi`.`tanggal_input`
      FROM `edukasi`
      WHERE TRUE
      AND `edukasi`.`slug`='".$parram['slug']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$data = mysqli_fetch_assoc($query);
	}
	return $data;
}