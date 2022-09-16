<?php
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
      SELECT
         `tanya_jawab`.`id`,
         `tanya_jawab`.`pasien_id`,
         `users`.`nama_lengkap`,
         `tanya_jawab`.`admin_id`,
         `tanya_jawab`.`no_tiket`,
         `tanya_jawab`.`perihal`,
         `tanya_jawab`.`status`,
         `tanya_jawab`.`tanggal_input`
      FROM `tanya_jawab`
      INNER JOIN `users` ON `tanya_jawab`.`pasien_id`=`users`.`id`
      WHERE TRUE
   ";
	$sql .= " ORDER BY `tanya_jawab`.`tanggal_input` DESC LIMIT ".$parram['startpoint'].", ".$global_limit;
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
		SELECT COUNT(`tanya_jawab`.`id`) AS 'total' FROM `tanya_jawab`
      INNER JOIN `users` ON `tanya_jawab`.`pasien_id`
		WHERE TRUE
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}
function Detail($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
      SELECT
         `tanya_jawab`.`id`,
         `tanya_jawab`.`pasien_id`,
         `users`.`nama_lengkap`,
         `tanya_jawab`.`admin_id`,
         `tanya_jawab`.`no_tiket`,
         `tanya_jawab`.`perihal`,
         `tanya_jawab`.`status`,
         `tanya_jawab`.`tanggal_input`
      FROM `tanya_jawab`
      INNER JOIN `users` ON `tanya_jawab`.`pasien_id`=`users`.`id`
      WHERE TRUE
		AND `tanya_jawab`.`id`='".$parram['id']."'
   ";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$data = mysqli_fetch_assoc($query);
	}
	return $data;
}
function DaftarReply($parram){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
      SELECT
         `tanya_jawab_chat`.`id`,
         `tanya_jawab_chat`.`tj_id`,
         `tanya_jawab_chat`.`pesan`,
         `tanya_jawab_chat`.`tipe`,
         `tanya_jawab_chat`.`read`,
         `tanya_jawab_chat`.`tanggal_input`
      FROM `tanya_jawab_chat`
      WHERE TRUE
      AND `tanya_jawab_chat`.`tj_id`='".$parram['tj_id']."'
      ORDER BY `tanya_jawab_chat`.`tanggal_input` ASC
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	return $data;
}
function InsertReply($parram){
	global $global_koneksi;
	$data = false;
	$sql = "
		INSERT INTO `tanya_jawab_chat`
		SET
			`tj_id`='".$parram['tj_id']."',
			`pesan`='".$parram['pesan']."',
			`tipe`='".$parram['tipe']."',
			`read`='".$parram['read']."',
			`tanggal_input`='".$parram['tanggal_input']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}