<?php

//Connecting database of Xampp
$conn = new mysqli('localhost', 'root', '', 'bank');

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());	
}
echo "Connected successfully. <br>";


//Setting max execution time to 200

ini_set('max_execution_time', 200);

//Creating Tables


$district = "CREATE TABLE IF NOT EXISTS district (
district_id INT(6) UNSIGNED PRIMARY KEY,
A2 varchar(50) NOT NULL,
A3 varchar(50) NOT NULL,
A4 int(6) UNSIGNED NOT NULL,
A5 int(6) UNSIGNED NOT NULL,
A6 int(6) UNSIGNED NOT NULL,
A7 int(6) UNSIGNED NOT NULL,
A8 int(6) UNSIGNED NOT NULL,
A9 int(6) UNSIGNED NOT NULL,
A10 int(6) UNSIGNED NOT NULL,
A11 int(6) UNSIGNED NOT NULL,
A12 int(6) UNSIGNED NOT NULL,
A13 int(6) UNSIGNED NOT NULL,
A14 int(6) UNSIGNED NOT NULL,
A15 int(6) UNSIGNED NOT NULL,
A16 int(6) UNSIGNED NOT NULL
);";


$account = "CREATE TABLE IF NOT EXISTS account (
account_id INT(10) UNSIGNED PRIMARY KEY,
district_id int(6) UNSIGNED NOT NULL,
frequency varchar(50) NOT NULL,
date INT(6) UNSIGNED NOT NULL,
CONSTRAINT fk_DISTRICT_to_ACCOUNT
FOREIGN KEY (district_id) REFERENCES district(district_id)
);";


$client = "CREATE TABLE IF NOT EXISTS client (
client_id INT(6) UNSIGNED PRIMARY KEY,
birth_number INT(8) UNSIGNED NOT NULL,
district_id int(6) UNSIGNED NOT NULL,
CONSTRAINT fk_DISTRICT_to_CLIENT
FOREIGN KEY (district_id) REFERENCES district(district_id)
);";


$disposition = "CREATE TABLE IF NOT EXISTS disposition (
disp_id INT(6) UNSIGNED PRIMARY KEY,
client_id INT(6) UNSIGNED NOT NULL,
account_id INT(10) UNSIGNED NOT NULL,
type varchar(50) NOT NULL,
CONSTRAINT fk_ACCOUNT_to_DISPOSITION
FOREIGN KEY (account_id) REFERENCES account(account_id),
CONSTRAINT fk_CLIENT_to_DISPOSITION
FOREIGN KEY (client_id) REFERENCES client(client_id)
);";

$card = "CREATE TABLE IF NOT EXISTS card (
card_id INT(6) UNSIGNED PRIMARY KEY,
disp_id INT(6) UNSIGNED NOT NULL,
type varchar(50) NOT NULL,
issued INT(6) UNSIGNED NOT NULL,
CONSTRAINT fk_DISPOSITION_to_CARD
FOREIGN KEY (disp_id) REFERENCES disposition(disp_id)
);";

//Rename table to order1 for creating again
//PHPMYADMIN bug not letting create table named 'order'
$order = "CREATE TABLE IF NOT EXISTS order1 (
order_id INT(6) UNSIGNED PRIMARY KEY,
account_id INT(10) UNSIGNED NOT NULL,
bank_to varchar(30) NOT NULL,
account_to INT(10) UNSIGNED NOT NULL,
amount INT(10) UNSIGNED NOT NULL,
k_symbol varchar(30) NOT NULL,
CONSTRAINT fk_ACCOUNT_to_ORDER
FOREIGN KEY (account_id) REFERENCES account(account_id)
);";

$loan = "CREATE TABLE IF NOT EXISTS loan (
loan_id INT(6) UNSIGNED PRIMARY KEY,
account_id int(10) UNSIGNED NOT NULL,
date INT(6) UNSIGNED NOT NULL,
amount int(10) UNSIGNED NOT NULL,
duration int(6) UNSIGNED NOT NULL,
payments int(10) UNSIGNED NOT NULL,
status varchar(6) NOT NULL,
CONSTRAINT fk_ACCOUNT_to_LOAN
FOREIGN KEY (account_id) REFERENCES account(account_id)
);";

$transaction = "CREATE TABLE IF NOT EXISTS transaction (
trans_id INT(10) UNSIGNED PRIMARY KEY,
account_id int(10) UNSIGNED NOT NULL,
date INT(6) UNSIGNED NOT NULL,
type varchar(50) NOT NULL,
operation varchar(50) NOT NULL,
amount INT(10) UNSIGNED NOT NULL,
balance INT(10) UNSIGNED NOT NULL,
k_symbol varchar(30) NOT NULL,
bank varchar(30) NOT NULL,
account int(10) UNSIGNED NOT NULL,
CONSTRAINT fk_ACCOUNT_to_TRANSACTION
FOREIGN KEY (account_id) REFERENCES account(account_id)
);";

mysqli_query($conn,$district);
mysqli_query($conn,$account);
mysqli_query($conn,$client);
mysqli_query($conn,$disposition);
mysqli_query($conn,$card);
mysqli_query($conn,$order);
mysqli_query($conn,$loan);
mysqli_query($conn,$transaction);
?>