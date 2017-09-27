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
$data = array();
$date = filter_var($_REQUEST['date'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$hour = filter_var($_REQUEST['hour'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$id_usuario   = filter_var($_REQUEST['id_usuario'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$n_pract   = filter_var($_REQUEST['n_pract'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
try {
	$sql  = "INSERT INTO Practicas(date, hour, id_up) VALUES(:date, :hour, :id_usuario)";
	$stmt    = $pdo->prepare($sql);
	$stmt->bindParam(':date', $date, PDO::PARAM_STR);
	$stmt->bindParam(':hour', $hour, PDO::PARAM_STR);
	$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
	$stmt->execute();
} catch(PDOException $e) {
	echo $e->getMessage();
}
try {
	$sql  = "UPDATE Usuarios SET n_pract = :n_pract WHERE (Usuarios.id_u = " . $id_usuario . ")";
    $stmt    = $pdo->prepare($sql);
    $stmt->bindParam(':n_pract', $n_pract, PDO::PARAM_STR);
    $stmt->execute();
    echo json_encode(array('message' => 'Se ha guardado la practica de' . $id_usuario . ' a la base de datos<br>Se ha modificado ' . $n_pract . ' a la cantidad de practicas'));
} catch(PDOException $e) {
	echo $e->getMessage();
}
?>