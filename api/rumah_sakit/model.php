<?php
function Daftar($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
      SELECT
         `rumah_sakit`.`id`,
         `rumah_sakit`.`nama`,
         `rumah_sakit`.`alamat`,
         `rumah_sakit`.`longitude`,
         `rumah_sakit`.`latitude`
      FROM `rumah_sakit`
      WHERE TRUE
	";
	$sql .= " ORDER BY `rumah_sakit`.`nama` ASC ";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	return $data;
}