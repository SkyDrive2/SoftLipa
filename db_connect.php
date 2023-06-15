<?php
$serverName = 'skydrive-sql,1433';
$database = 'softlipa';
$username = 'sa';
$db_password = 'Test123456...';


$connect = "sqlsrv:Server=$serverName;Database=$database,TrustServerCertificate=1";

try {
    $command = "python3 " . $_SERVER['DOCUMENT_ROOT'] . "/SQL_File/insert.py";
    exec($command, $output);

    $conn = new PDO($connect, $username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '失敗了bro' . $e->getMessage();
}
?>