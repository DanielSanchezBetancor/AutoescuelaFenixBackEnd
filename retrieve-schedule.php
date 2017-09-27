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
$data = array();
try {
	$stmt    = $pdo->query('SELECT date, hour FROM Practicas ORDER BY date ASC, hour ASC');
    while($row  = $stmt->fetch(PDO::FETCH_OBJ)) {
        $data[] = $row;
    }
	echo json_encode($data);
} catch(PDOException $e) {
      echo $e->getMessage();
}
?>