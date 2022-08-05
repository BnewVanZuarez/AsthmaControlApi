<?php
function UpdateProfil($parram){
	global $global_koneksi;
	$data = false;
	$sql	= "
		UPDATE `users`
		SET 
         `nama_lengkap`='".$parram['nama_lengkap']."',
         `no_telp`='".$parram['no_telp']."'
   ";
   if ($parram['password'] != "") {
      $sql .= " , `password`='".$parram['password']."' ";
   }
   $sql .= " WHERE `id`='".$parram['id']."' ";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}