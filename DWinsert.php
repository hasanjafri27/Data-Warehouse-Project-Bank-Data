<?php
$conn = new mysqli('localhost', 'root', '', 'bank');

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());	
}
echo "Connected successfully. <br>";


//Setting max execution time to 200

ini_set('max_execution_time', 250);


	$district_file='district.txt';
    $account_file='account.txt';
    $client_file='client.txt';
    $disposition_file='disp.txt';
    $card_file='card.txt';
    $order_file='order.txt';
    $loan_file='loan.txt';
    $transaction_file='trans.txt';

    mysqli_query($conn, 'DELETE from district;');
    mysqli_query($conn, 'DELETE from account;');
    mysqli_query($conn, 'DELETE from client;');
    mysqli_query($conn, 'DELETE from disposition;');
    mysqli_query($conn, 'DELETE from card;');
    mysqli_query($conn, 'DELETE from order1;');
    mysqli_query($conn, 'DELETE from loan;');
    mysqli_query($conn, 'DELETE from transaction;');

    mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$district_file.'" INTO TABLE district
	FIELDS TERMINATED by \';\'
	LINES TERMINATED BY \'\n\'
	IGNORE 1 LINES
	(district_id,A2,A3,A4,A5,A6,A7,A8,A9,A10,A11,A12,A13,A14,A15,A16)
    ');

    mysqli_query($conn, 'SET foreign_key_checks = 0;');
    mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$account_file.'" INTO TABLE account
    FIELDS TERMINATED by \';\'
    LINES TERMINATED BY \'\n\'
    IGNORE 1 LINES
    (account_id,district_id,frequency,date)
    ');
    //SET country_id = rand()* 49

	    mysqli_query($conn, 'SET foreign_key_checks = 0;');
    mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$client_file.'"
    INTO TABLE client
    FIELDS TERMINATED by \';\'
    LINES TERMINATED BY \'\n\'
    IGNORE 1 LINES
    (client_id,birth_number,district_id)
    ');
    //SET passenger_id = rand()* 299 ,
    //    employee_id = rand()* 100

	
/*     FIELDS TERMINATED by \',\'*/
	mysqli_query($conn, 'SET foreign_key_checks = 0;');
    mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$disposition_file.'" 
	INTO TABLE disposition
    FIELDS TERMINATED by \';\'
    LINES TERMINATED BY \'\n\'
    IGNORE 1 LINES
    (disp_id,client_id,account_id,type)
    ');
	//SET passenger_id = rand()* 299,
	//	seat_no = rand()* 149

    mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$card_file.'"
	INTO TABLE card
    FIELDS TERMINATED by \';\'
    LINES TERMINATED BY \'\n\'
    IGNORE 1 LINES
    (card_id,disp_id,type,issued)
    ');
    //SET flights_schedule_id = rand()* 1050000

    mysqli_query($conn, 'SET foreign_key_checks = 0;');
    mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$order_file.'"
	INTO TABLE order1
    FIELDS TERMINATED by \';\'
    LINES TERMINATED BY \'\n\'
    IGNORE 1 LINES
    (order_id,account_id,bank_to,account_to,amount,k_symbol)
    ');
    //SET terminal_id = rand()* 49


	mysqli_query($conn, 'SET foreign_key_checks = 0;');
	mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$loan_file.'"
	INTO TABLE loan
	FIELDS TERMINATED by \';\'
	LINES TERMINATED BY \'\n\'
	IGNORE 1 LINES
	(loan_id,account_id,date,amount,duration,payments,status)
	');

	mysqli_query($conn, 'SET foreign_key_checks = 0;');
	mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$transaction_file.'"
	INTO TABLE transaction
	FIELDS TERMINATED by \';\'
	LINES TERMINATED BY \'\n\'
	IGNORE 1 LINES
	(trans_id,account_id,date,type,operation,amount,balance,k_symbol,bank,account)
	');
	//SET terminal_id = rand()* 49



/* <?php
$deleterecords = "TRUNCATE TABLE discount"; //empty the table of its current records
mysql_query($deleterecords);
//readfile($name);
//Import uploaded file to Database
$handle = fopen($name, "r");

$i=0;
$what_to_insert = array();
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    if($i>0){
        array_push($what_to_insert, "('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."')");
    }
    $i=1;
}
fclose($handle);
if (count($what_to_insert)>0){
    $import="INSERT into discount(id,title,expired_date,amount,block) values " . implode(",", $what_to_insert);
    mysql_query($import) or die(mysql_error());//query
}
?>
 */

 
 
 /* SET autocommit=0;
SET unique_checks=1;
SET foreign_key_checks=0;

  LOAD DATA INFILE myfile.txt ESCAPED BY ' '
  INTO TABLE mytable

SET unique_checks=1;o
SET foreign_key_checks=1;
COMMIT */
 
 
 
 
 ?>