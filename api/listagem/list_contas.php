<?php
require_once '../../config/conn.php';

//Listar contas a pagar e filtrar


$empresaFiltro = '';
$valorFiltro = '';
$dataFiltro = '';
$condicao = '';

if (isset($_GET['empresa'])) {
        $empresaFiltro = $_GET['empresa'];
}

if (isset($_GET['valor'])) {
        $valorFiltro = $_GET['valor'];
}

if (isset($_GET['data'])) {
        $dataFiltro = $_GET['data'];
}

if (isset($_GET['condicao'])) {
        $condicao = $_GET['condicao'];
}

$sql = "SELECT cp.*, te.nome AS nome_empresa 
        FROM tbl_conta_pagar cp
        INNER JOIN tbl_empresa te ON cp.id_empresa = te.id_empresa
        WHERE 1";

if (!empty($empresaFiltro)) {
        $sql .= " AND te.nome LIKE :empresa";
}

if (!empty($valorFiltro)) {
        $sql .= " AND cp.valor = :valor";
}

if (!empty($dataFiltro)) {
        $sql .= " AND cp.data_pagar = :data";
}

if ($condicao == 'MAIOR') {
        $sql .= " ORDER BY cp.valor DESC"; // Ordenar do maior para o menor valor
} elseif ($condicao == 'MENOR') {
        $sql .= " ORDER BY cp.valor ASC"; // Ordenar do menor para o maior valor
}

$stmt = $pdo->prepare($sql);

if (!empty($empresaFiltro)) {
        $stmt->bindValue(':empresa', '%' . $empresaFiltro . '%');
}

if (!empty($valorFiltro)) {
        // remover ponto e substituir vírgula por ponto na string
        $valorFiltro = str_replace('.', '', $valorFiltro);
        $valorFiltro = str_replace(',', '.', $valorFiltro);
        $stmt->bindValue(':valor', $valorFiltro);
}

if (!empty($dataFiltro)) {
        $stmt->bindValue(':data', $dataFiltro);
}

$stmt->execute();

$contasPagar = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($contasPagar);
