<?php
$serverName = 'localhost,1433';
$database = 'project';
$username = 'SA';
$db_password = 'Test123456...';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");
try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '雞巴失敗了' . $e->getMessage();
}
?>