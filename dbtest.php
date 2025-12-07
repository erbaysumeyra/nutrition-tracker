<?php
try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;port=3307;dbname=nutrition",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "OK\n";
    $r = $pdo->query("SELECT @@version AS v, @@port AS p")->fetchAll(PDO::FETCH_ASSOC);
    print_r($r);
} catch (Throwable $e) {
    echo "ERR: " . $e->getMessage() . "\n";
}
