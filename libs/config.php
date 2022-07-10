<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
date_default_timezone_set('Asia/Jakarta');

// Koneksi
$host = 'localhost';
$user = 'root';
$pass = 'ibnuraffi';
$db   = 'asthma_control';

$global_koneksi  = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error());
// End Koneksi

// Global Variable
$global_protocol	= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://");
$global_www			= (substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.' ? 'www.' : '');
$global_base_url	= $global_protocol.$global_www.'192.168.8.104/AsthmaControlApi/';
$admin_base_url	= $global_protocol.$global_www.'localhost/AsthmaControlApi/admin/';
$webview_base_url	= $global_protocol.$global_www.'localhost/AsthmaControlApi/webview/';
$global_limit		= 50;
$global_upload_file = 'files/';
$global_versi     = "1.0";
// End Global Variable