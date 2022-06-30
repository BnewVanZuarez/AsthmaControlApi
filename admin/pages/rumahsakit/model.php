<?php
// Insert
function Insert($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `rumah_sakit`
		SET
			`nama`='".$parram['nama']."',
			`alamat`='".$parram['alamat']."',
			`longitude`='".$parram['longitude']."',
			`latitude`='".$parram['latitude']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
// Insert End

// List
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
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
// List End

// Detail
function Detail($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
      SELECT * FROM `rumah_sakit` 
      WHERE TRUE
		AND `rumah_sakit`.`id` = '".$parram['id']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$data = mysqli_fetch_assoc($query);
	}
	return $data;
}
// Detail End

// Update
function Update($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		UPDATE `rumah_sakit`
		SET
         `nama`='".$parram['nama']."',
         `alamat`='".$parram['alamat']."',
         `longitude`='".$parram['longitude']."',
         `latitude`='".$parram['latitude']."'
      WHERE `rumah_sakit`.`id`='".$parram['id']."'
   ";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
// Update End