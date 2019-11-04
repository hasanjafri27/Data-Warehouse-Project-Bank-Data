<?php
$conn = new mysqli('localhost', 'root', '', 'bank');

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
echo "Connected successfully. <br>";

mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0;");


mysqli_query($conn, "DROP TABLE IF EXISTS district;");
echo"tbl 1<br>";
mysqli_query($conn, "DROP TABLE IF EXISTS account;");
echo"tbl 2<br>";
mysqli_query($conn, "DROP TABLE IF EXISTS client;");
echo"tbl 3<br>";
mysqli_query($conn, "DROP TABLE IF EXISTS disposition;");
echo"tbl 4<br>";
mysqli_query($conn, "DROP TABLE IF EXISTS card;");
echo"tbl 5<br>";
mysqli_query($conn, "DROP TABLE IF EXISTS order1;");
echo"tbl 6<br>";
mysqli_query($conn, "DROP TABLE IF EXISTS loan;");
echo"tbl 7<br>";
mysqli_query($conn, "DROP TABLE IF EXISTS transaction;");
echo "tbl 8<br>";


mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0;");
mysqli_query($conn, "SET @tables = NULL;");
mysqli_query($conn, "SELECT GROUP_CONCAT(table_schema, '.', table_name) INTO @tables
  FROM information_schema.tables 
  WHERE table_schema = 'bank'; 

SET @tables = CONCAT('DROP TABLE ', @tables);
PREPARE stmt FROM @tables;");
mysqli_query($conn, "EXECUTE stmt;");
mysqli_query($conn, "DEALLOCATE PREPARE stmt;");
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1;");

/* mysqli_query($conn, "DROP TABLE IF EXISTS payment, airfare, flights_schedule, transactions, employee, terminal, reservation, passenger, country_list;");
 */

?>


