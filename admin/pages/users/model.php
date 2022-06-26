<?php
// Insert
function Insert($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `users`
		SET
			`email`='".$parram['email']."',
			`password`='".$parram['password']."',
			`nama_lengkap`='".$parram['nama_lengkap']."',
			`no_telp`='".$parram['no_telp']."',
			`level`='".$parram['level']."',
			`status`='".$parram['status']."',
			`tanggal_input`='".$parram['tanggal_input']."'
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
			`users`.`id`,
			`users`.`email`,
			`users`.`password`,
			`users`.`nama_lengkap`,
			`users`.`no_telp`,
			`users`.`level`,
			`users`.`status`,
			`users`.`tanggal_input`
		FROM `users`
		WHERE TRUE
	";
	$sql .= " ORDER BY `users`.`id` ASC ";
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
      SELECT * FROM `users` 
      WHERE TRUE
		AND `users`.`id` = '".$parram['id']."'
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
		UPDATE `users`
		SET
			`email`='".$parram['email']."',
			`password`='".$parram['password']."',
			`nama_lengkap`='".$parram['nama_lengkap']."',
			`no_telp`='".$parram['no_telp']."',
			`level`='".$parram['level']."',
			`status`='".$parram['status']."'
      WHERE `users`.`id`='".$parram['id']."'
   ";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
// Update End