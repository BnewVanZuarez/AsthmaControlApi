<?php
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	global $global_base_url;
	global $global_upload_file;
	$data = array();
	$sql  = "
      SELECT
         `daily_jurnal`.`id`,
         DATE_FORMAT(`daily_jurnal`.`tanggal`, '%d %b %Y') AS 'tanggal',
         `daily_jurnal`.`rate_today`,
         `daily_jurnal`.`rate_pain`,
         `daily_jurnal`.`mood_today`,
         `daily_jurnal`.`tanggal_input`
      FROM `daily_jurnal`
      WHERE TRUE
		AND `daily_jurnal`.`users_id`='".$parram['users_id']."'
	";
	$sql .= " ORDER BY `daily_jurnal`.`tanggal_input` DESC LIMIT ".$parram['startpoint'].", ".$global_limit;
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
		SELECT COUNT(`daily_jurnal`.`id`) AS 'total' FROM `daily_jurnal`
		WHERE TRUE
		AND `daily_jurnal`.`users_id`='".$parram['users_id']."'
	";
	$query = mysqli_query($global_koneksi, $sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_assoc($query);
		$data = $row['total'];
	}
	return $data;
}
function Input($parram){
	global $global_koneksi;
	$data = false;
	$sql	 = "
		INSERT INTO `daily_jurnal`
		SET 
         `users_id`='".$parram['users_id']."',
         `tanggal`='".$parram['tanggal']."',
         `rate_today`='".$parram['rate_today']."',
         `rate_pain`='".$parram['rate_pain']."',
         `mood_today`='".$parram['mood_today']."',
         `gejala`='".$parram['gejala']."',
         `gejala_value`='".$parram['gejala_value']."',
         `paparan`='".$parram['paparan']."',
         `paparan_alergen`='".$parram['paparan_alergen']."',
         `nafsu_makan`='".$parram['nafsu_makan']."',
         `kelelahan`='".$parram['kelelahan']."',
         `aktivitas`='".$parram['aktivitas']."',
         `aktivitas_durasi`='".$parram['aktivitas_durasi']."',
         `aktivitas_intensitas`='".$parram['aktivitas_intensitas']."',
         `notes`='".$parram['notes']."',
         `tanggal_input`='".$parram['tanggal_input']."'
	";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}