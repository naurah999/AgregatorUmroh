<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $mysqli = new mysqli("127.0.0.1", "root", "", "agregator_umroh");
    echo "DB OK - mysqli 127.0.0.1\n";
} catch (mysqli_sql_exception $e) {
    echo "DB ERROR (mysqli 127.0.0.1): " . $e->getMessage() . "\n";
}
