<?php
// Login
function Login($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
		SELECT
			`users`.`id`,
			`users`.`email`,
			`users`.`password`,
			`users`.`nama_lengkap`,
			`users`.`level`,
			`users`.`status`
		FROM `users`
		WHERE TRUE
		AND `users`.`email`='".$parram['email']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$data = mysqli_fetch_assoc($query);
	}
	return $data;
}
function UpdateHash($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		UPDATE `users`
		SET `hash`='".$parram['hash']."'
		WHERE `email` = '".$parram['email']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
function loginWithHash($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
		SELECT
			`users`.`id`,
			`users`.`email`,
			`users`.`password`,
			`users`.`nama_lengkap`,
			`users`.`no_telp`,
			`users`.`level`,	
			`users`.`status`
		FROM `users`
		WHERE TRUE
		AND `users`.`email` = '".$parram['email']."' AND `users`.`hash` = '".$parram['hash']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$data = mysqli_fetch_assoc($query);
	}
	return $data;
}
// Login End