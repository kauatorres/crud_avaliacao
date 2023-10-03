<?php
require_once '../../config/conn.php';

$sql = "SELECT * FROM tbl_empresa";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($empresas);
