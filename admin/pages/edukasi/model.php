<?php
// List
function Daftar($parram){
	global $global_koneksi;
	global $global_limit;
	$data = array();
	$sql  = "
		SELECT
			`edukasi`.`id`,
			`edukasi`.`slug`,
			`edukasi`.`writer`,
			`edukasi`.`judul`,
			`edukasi`.`gambar`,
			`edukasi`.`video`,
			`edukasi`.`tanggal_input`
		FROM `edukasi`
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
			`writer`='".$parram['writer']."',
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

// Detail
function Detail($parram){
	global $global_koneksi;
	$data = array();
	$sql  = "
      SELECT * FROM `edukasi` 
      WHERE TRUE
		AND `edukasi`.`id` = '".$parram['id']."'
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
		UPDATE `edukasi`
		SET
			`writer`='".$parram['writer']."',
			`slug`='".$parram['slug']."',
			`judul`='".$parram['judul']."',
	";
	if ($parram['gambar'] != "") {
		$sql .= " `gambar`='".$parram['gambar']."', ";
	}
	$sql .= " `video`='".$parram['video']."',
			`detail`='".$parram['detail']."'
		WHERE `id`='".$parram['id']."'
   ";
   if(mysqli_query($global_koneksi, $sql)){
   	$data = true;
   }
   return $data;
}
// Update End