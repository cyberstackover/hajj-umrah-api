<?php
header('Access-Control-Allow-Origin: *');

error_reporting(E_ALL ^ E_DEPRECATED);
$servername = "herwintika.id";
$username = "herwinti";
$password = "hgyM00F5i6";
$dbname = "herwinti_sapahaji";
// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

// $id = $_REQUEST['idmember'];
// $promotit = $_REQUEST['promot'];
// $promodesc = $_REQUEST['detail'];

$id = $_POST['idmember'];
$promotit = $_POST['promot'];
$promodesc = $_POST['detail'];

$Destination = '../files/pic/promosi';
if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name'])){
    $NewImageName= 'default.jpg';
    move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
}
// if ( 0 < $_FILES['ImageFile']['error'] ) {
//         // echo 'Error: ' . $_FILES['file']['error'] . '<br>';
//         $NewImageName= 'default.jpg';
// }
else{
    $RandomNum = rand(0, 9999999999);
    $ImageName = str_replace(' ','-',strtolower($_FILES['ImageFile']['name']));
    $ImageType = $_FILES['ImageFile']['type'];
    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt = str_replace('.','',$ImageExt);
    $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName = substr($ImageName,0,10).'-'.$RandomNum.'.'.$ImageExt;
    move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
}

$data="INSERT INTO promosi (tittle,detail_promosi,promopic,update_by,date_update) VALUES ('$promotit', '$promodesc', '$NewImageName', '$id', NOW())";
$query=mysql_query($data);

// print_r($data);
// print_r($query);

//redirect to index page
	// header('Location: ../www/index_login.html?id='.$id);
	// exit;

?>