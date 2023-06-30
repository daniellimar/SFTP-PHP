<?php
require 'vendor/autoload.php';
require 'Helpers/FTPDownloader.php';
include_once 'settings.php';

$ftpDownloader = new FTPDownloader($ftpServer, $ftpUsername, $ftpUserpass);

$date = date("Y-m-d-H-i-s");
$localFile = "src/local_{$date}.php";
$serverFile = 'table.php';

$ftpDownloader->downloadFile($serverFile, $localFile);
?>