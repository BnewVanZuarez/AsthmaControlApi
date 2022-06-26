<?php
// List
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
		SELECT
			`edukasi`.`id`,
			`edukasi`.`users_id`,
			`edukasi`.`slug`,
			`edukasi`.`judul`,
			`edukasi`.`gambar`,
			`edukasi`.`video`,
			`edukasi`.`tanggal_input`,
			`users`.`nama_lengkap`
		FROM `edukasi`
		LEFT JOIN `users` ON `edukasi`.`users_id`=`users`.`id`
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
		INNER JOIN `users` ON `edukasi`.`users_id`=`users`.`id`
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

// Insert
function Insert($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `edukasi`
		SET
			`users_id`='".$parram['users_id']."',
			`slug`='".$parram['slug']."',
			`judul`='".$parram['judul']."',
			`gambar`='".$parram['gambar']."',
			`video`='".$parram['video']."',
			`detail`='".$parram['detail']."',
			`tanggal_input`='".$parram['tanggal_input']."'
   ";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
// Insert End