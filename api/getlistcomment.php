<?php
header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL ^ E_DEPRECATED);
$servername = "herwintika.id";
$username = "herwinti";
$password = "hgyM00F5i6";
$dbname = "herwinti_sapahaji";
mysql_connect($servername, $username, $password) or
    die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$idpost = $_POST['id'];

$items_1 = mysql_query("SELECT * FROM comment JOIN user_data ON comment.comment_by = user_data.id AND id_post like '$idpost' AND com_type like 'comment'");

$records = array();
$log = array();
$tmp = array();

while( $row_1 = mysql_fetch_array( $items_1,MYSQLI_ASSOC ) ) {
	array_push($records,$row_1);
}
$total=count($records);


if ($total > 0) {
	# code...
	$log['Status'] = 'Success';
	$log['Data'] = $records;
	$tmp[] = $log;
	
} else {
	# code...
	$log['Status'] = 'Fail';
	$tmp[] = $log;

}


// echo $text;
$data = "{\"List_Status\" : ".json_encode($tmp)."}";
echo $data; 
?>