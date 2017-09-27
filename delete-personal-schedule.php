<?php
header('Access-Control-Allow-Origin: *');
$hn = 'localhost';
$un = '--';
$pwd = '--';
$db = '--';
$cs = 'utf8';
$dsn = "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
$opt = array(
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES   => false,
);
$pdo = new PDO($dsn, $un, $pwd, $opt);
$id_p = filter_var($_REQUEST['id_p'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$sql = 'DELETE FROM Practicas WHERE id_p = ' . $id_p;
$stmt = $pdo->query($sql);
echo json_encode(array('message' => 'Se ha eliminado ' . $id_p . ' de la base de datos'));
?>