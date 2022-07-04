<?php
function UpdateReset($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		UPDATE `users`
		SET `reset`='".$parram['reset']."'
		WHERE `email` = '".$parram['email']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
function CekOtp($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
		SELECT
			`users`.`id`,
			`users`.`email`
		FROM `users`
		WHERE `reset` = '".$parram['reset']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$data = mysqli_fetch_assoc($query);
	}
	return $data;
}
function UpdatePassword($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		UPDATE `users`
		SET 
         `password`='".$parram['password']."',
		   `reset`=NULL
		WHERE `email` = '".$parram['email']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
function InputRegister($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `users`
		SET 
         `email`='".$parram['email']."',
         `password`='".$parram['password']."',
         `nama_lengkap`='".$parram['nama']."',
         `no_telp`='".$parram['no_telp']."',
         `level`='".$parram['level']."',
         `status`='".$parram['aktif']."',
         `tanggal_input`='".$parram['tanggal_input']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}