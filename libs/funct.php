<?php
// Create a new SimpleImage object
require 'SimpleImage.php';
$simple_image = new \claviska\SimpleImage();
// Create a new SimpleImage object End

// XSS Protection
function Escape($string){
	global $global_koneksi;
	$string1 = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
	$string2 = htmlentities($string1, ENT_QUOTES, 'UTF-8');
	$string3 = mysqli_real_escape_string($global_koneksi, $string2);
	return $string3;
}
function stringAllow($parram){
	$data = false;
	if(preg_match($parram['where'], $parram['text'])){
  		$data = true;
	}
	return $data;
}
function HtmlDecode($parram){
	$string = html_entity_decode($parram['text']);
	return $string;
}
// XSS Protection End

// Whatsapp Number
function NoWhatsapp($parram){
	$new = substr($parram['nomor'], 1);
	if (substr($parram['nomor'], 0, 1) == "0") {
		$new = "62".$new;
	}elseif (substr($parram['nomor'], 0, 1) == "8") {
		$new = "62".$parram['nomor'];
	}elseif (substr($parram['nomor'], 0, 1) == "6") {
		$new = $parram['nomor'];
	}
	return $new;
}
// Whatsapp Number End

// Create Random String
function RandomString($length){
	$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$pieces = [];
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
		$pieces []= $keyspace[random_int(0, $max)];
	}
	return implode('', $pieces);
}
// Create Random String End

// Create Slug
function CreateSlug($text){
   $text = preg_replace('~[^\pL\d]+~u', '-', $text);// replace non letter or digits by -
   $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);// transliterate
   $text = preg_replace('~[^-\w]+~', '', $text);// remove unwanted characters
   $text = trim($text, '-');// trim
   $text = preg_replace('~-+~', '-', $text);// remove duplicate -
   $text = strtolower($text);// lowercase
   if (empty($text)) {
      return 'n-a';
   }
   return $text;
}
// Create Slug End

// Upload File
function uploadFile($parram){
	// global $simple_image;
	$datetime = date("Y-m-d-H-i-s-");
	$file = ''; //nama file
	//random nama file 1
	do{
		$file = $parram['nama'] .'-'. $datetime . rand() . '.' . $parram['format'];
	}while(file_exists($parram['dir'] . $file));
		move_uploaded_file($parram['tmp_name'], $parram['dir'] . $file);
	return $file;
}
function uploadGambar($parram){
   global $simple_image;
   $datetime = date("Y-m-d-H-i-s-");
   $gambar = ''; //nama gambar
   //random nama gambar 1
   do{
      $gambar = $parram['nama'] .'-'. $datetime . rand() . '.' . $parram['format'];
   }while(file_exists($parram['dir'] . $gambar));
   if (move_uploaded_file($parram['tmp_name'], $parram['dir'] . $gambar)) {//upload file
      //create thumb
      try {
         // Manipulate it
         $simple_image
         ->fromFile($parram['dir'] . $gambar)
         // ->crop($x1, $y1, $x2, $y2)
         ->thumbnail(512, 512, 'center')
         ->toFile($parram['dir'] . 'thumb/' . $gambar, 'image/jpeg', 10);
      } catch(Exception $err) {
         // Handle errors
         echo $err->getMessage();
      }
   }
   return $gambar;
}
// Upload File End

// Date Format Indo
function tanggal_indo($tanggal){
	$bulan = array (1 =>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
function hari_ini($tanggal){
	$date = date_create($tanggal);
	$hari = date_format($date,"D");
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
			break;
		case 'Mon':
			$hari_ini = "Senin";
			break;
		case 'Tue':
			$hari_ini = "Selasa";
			break;
		case 'Wed':
			$hari_ini = "Rabu";
			break;
		case 'Thu':
			$hari_ini = "Kamis";
			break;
		case 'Fri':
			$hari_ini = "Jumat";
			break;
		case 'Sat':
			$hari_ini = "Sabtu";
			break;
		default:
			$hari_ini = "Tidak di ketahui";
			break;
		}
	return $hari_ini;
}
function bulan_ini($bulan){
	switch($bulan){
		case '01':
			$bulan_ini = "Januari";
			break;
		case '02':
			$bulan_ini = "Februari";
			break;
		case '03':
			$bulan_ini = "Maret";
			break;
		case '04':
			$bulan_ini = "April";
			break;
		case '05':
			$bulan_ini = "Mei";
			break;
		case '06':
			$bulan_ini = "Juni";
			break;
		case '07':
			$bulan_ini = "Juli";
			break;
		case '08':
			$bulan_ini = "Agustus";
			break;
		case '09':
			$bulan_ini = "September";
			break;
		case '10':
			$bulan_ini = "Oktober";
			break;
		case '11':
			$bulan_ini = "November";
			break;
		case '12':
			$bulan_ini = "Desember";
			break;
		default:
			$bulan_ini = "Tidak di ketahui";
			break;
		}
	return $bulan_ini;
}
function bulan_romawi($bulan){
	switch($bulan){
		case '01':
			$bulan_ini = "I";
			break;
		case '02':
			$bulan_ini = "II";
			break;
		case '03':
			$bulan_ini = "III";
			break;
		case '04':
			$bulan_ini = "IV";
			break;
		case '05':
			$bulan_ini = "V";
			break;
		case '06':
			$bulan_ini = "VI";
			break;
		case '07':
			$bulan_ini = "VII";
			break;
		case '08':
			$bulan_ini = "VIII";
			break;
		case '09':
			$bulan_ini = "IX";
			break;
		case '10':
			$bulan_ini = "X";
			break;
		case '11':
			$bulan_ini = "XI";
			break;
		case '12':
			$bulan_ini = "XII";
			break;
		default:
			$bulan_ini = "00";
			break;
		}
	return $bulan_ini;
}
function Ucapan(){
	$waktu = gmdate("H:i",time()+7*3600);
	$t		 = explode(":",$waktu);
	$jam 	 = $t[0];
	$menit = $t[1];
	
	if ($jam >= 00 and $jam < 10 ){
		if ($menit >00 and $menit<60){
			$ucapan = "Selamat Pagi";
		}
	}else if ($jam >= 10 and $jam < 15 ){
		if ($menit >00 and $menit<60){
			$ucapan = "Selamat Siang";
		}
	}else if ($jam >= 15 and $jam < 18 ){
		if ($menit >00 and $menit<60){
			$ucapan = "Selamat Sore";
		}
	}else if ($jam >= 18 and $jam <= 24 ){
		if ($menit >00 and $menit<60){
			$ucapan = "Selamat Malam";
		}
	}else {
		$ucapan="Error";
	}
	return $ucapan;
}
// Date Format Indo

function formatBytes($bytes, $precision = 2) { 
	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	$bytes = max($bytes, 0); 
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	$pow = min($pow, count($units) - 1); 

	// Uncomment one of the following alternatives
	// $bytes /= pow(1024, $pow);
	// $bytes /= (1 << (10 * $pow)); 

	return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
// Convert File Size End

// IP
function ip_user(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
// IP End