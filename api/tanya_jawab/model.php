<?php
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
      SELECT
         `tanya_jawab`.`id`,
         `tanya_jawab`.`no_tiket`,
         `tanya_jawab`.`perihal`,
         `tanya_jawab`.`status`,
         `tanya_jawab`.`tanggal_input`
      FROM `tanya_jawab`
      WHERE TRUE
      AND `tanya_jawab`.`pasien_id`='".$parram['pasien_id']."'
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
		WHERE TRUE
      AND `tanya_jawab`.`pasien_id`='".$parram['pasien_id']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}
function ChatBaru($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `tanya_jawab`
		SET 
         `pasien_id`='".$parram['pasien_id']."',
         `no_tiket`='".$parram['no_tiket']."',
         `perihal`='".$parram['perihal']."',
         `status`='".$parram['status']."',
         `tanggal_input`='".$parram['tanggal_input']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
function DetailChat($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
      SELECT
         `tanya_jawab`.`id`,
         `tanya_jawab`.`no_tiket`,
         `tanya_jawab`.`perihal`,
         `tanya_jawab`.`status`
      FROM `tanya_jawab`
      WHERE TRUE
      AND `tanya_jawab`.`id`='".$parram['id']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$data = mysqli_fetch_assoc($query);
	}
	return $data;
}
function DaftarPesan($parram){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
      SELECT
         `tanya_jawab_chat`.`id`,
         `tanya_jawab_chat`.`pesan`,
         `tanya_jawab_chat`.`tipe`,
         `tanya_jawab_chat`.`read`,
         `tanya_jawab_chat`.`tanggal_input`
      FROM `tanya_jawab_chat`
      WHERE TRUE
	";
	$sql .= " ORDER BY `tanya_jawab_chat`.`tanggal_input` DESC ";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
	}
	return $data;
}
function KirimPesan($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `tanya_jawab_chat`
		SET 
         `tj_id`='".$parram['tj_id']."',
         `pesan`='".$parram['pesan']."',
         `tipe`='".$parram['tipe']."',
         `tanggal_input`='".$parram['tanggal_input']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}