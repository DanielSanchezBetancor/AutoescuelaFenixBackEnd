<?php
header('Access-Control-Allow-Origin: *');
$hn      = 'localhost';
$un      = 'id1494402_danaladanazo';
$pwd     = 'iicme1994';
$db      = 'id1494402_aefenixbd';
$cs      = 'utf8';
$dsn  = "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
$opt  = array(
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES   => false,
);
$pdo  = new PDO($dsn, $un, $pwd, $opt);
$data = array();
try {
	$stmt    = $pdo->query('SELECT id_u, user, pass, role, n_pract FROM Usuarios');
    while($row  = $stmt->fetch(PDO::FETCH_OBJ))
    {
		$data[] = $row;
    }
	echo json_encode($data);
} catch(PDOException $e) {
      echo $e->getMessage();
}
?>