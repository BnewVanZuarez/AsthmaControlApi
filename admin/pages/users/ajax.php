<?php
header('Content-Type: application/json;charset=utf-8');
$data_id	= isset($post['id']) ? $post['id'] : '';
$aksi		= isset($post['aksi']) ? $post['aksi'] : '';

if ($aksi == 'detail') {

	$info  = '';
	if ($info == '') {
		if ($data_id == '') {
			$info = 'Data Id Tidak Boleh Kosong ! Silahkan Coba Lagi !';
		}elseif (!stringAllow(array("where" => "/^[0-9]*$/", "text" => $data_id)) ) {
			$info = "Data Id hanya boleh karakter : " . "\n" . "1) 0 sampai 9" . "\n";
		}
	}
	
	if ($info == '') {
		$data 	= Detail(array('id' => Escape($data_id)));
	}
	
	echo json_encode(array(
		'status' => true,
		'data' => $data,
		'info' => $info
	));

}else{
	
	echo json_encode(array(
		'status' => true,
		'data' => '',
		'info' => 'Unknown Error !'
	));
}