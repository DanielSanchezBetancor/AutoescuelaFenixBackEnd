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
$name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$pass = filter_var($_REQUEST['pass'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$role   = filter_var($_REQUEST['role'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
try {
	$sql  = "INSERT INTO Usuarios(user, pass, role) VALUES(:name, :pass, :role)";
    $stmt    = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    $stmt->execute();
	echo json_encode(array('message' => 'Se ha guardado ' . $name . ' a la base de datos'));
} catch(PDOException $e) {
	echo $e->getMessage();
}
?>