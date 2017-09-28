<?php
header('Access-Control-Allow-Origin: *');
$hn = 'localhost';
$un = '--';
$pwd = '--';
$db = '--';
$cs = 'utf8';
$dsn = "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
$opt  = array(
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES   => false,
);
$pdo  = new PDO($dsn, $un, $pwd, $opt);
$id = filter_var($_REQUEST['id'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
$data = array();
try {
	$sql = 'SELECT Practicas.date, Practicas.hour, Practicas.id_p, Usuarios.n_pract FROM Practicas, Usuarios  WHERE (Practicas.id_up = ' . $id . ') AND (Usuarios.id_u = Practicas.id_up)';
    $stmt    = $pdo->query($sql);
	while($row  = $stmt->fetch(PDO::FETCH_OBJ))
    {
		$data[] = $row;
    }
	echo json_encode($data);
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>