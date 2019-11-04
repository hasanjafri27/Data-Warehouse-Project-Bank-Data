# Data WareHousing Of Bank Data
## by Hassan Abbas Jaffri (DDP-FA14-BSE-139)
## and Faizan Ikram (DDP-FA14-BSE-064)

## First Deliverable

### 1. Introduction

> We will be using data mart technique to develop our data warehouse. The two data marts will revolve around transactions and orders. The transaction fact table deals with the credits, debits, withdraws and bank transfers facts. The orders fact table deals with the permanent orders that are issued on monthly basis for household, lease, loan and insurance payments.
The reason behind choosing star model is:
We do not require rapid change.
Star modeling has simple structure hence easy to understand schema.
It has great query effectives so small number of tables to join
It has relatively long time of loading data into dimension tables, de-normalization, redundancy data caused that size of the table could be large.
It is the most commonly used in the data warehouse implementations, widely supported by a large number of business intelligence tools

### 2. ERD Diagram

## Second Deliverable

### Data Population

> <?php
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

## Third Deliverable

### 1. Star Schema

### 2. Star Schema Table Structure

## Fourth Deliverable

### 1. Fact Query
 >use banksystem

select bank.transaction1.account_id,bank.disposition.client_id,
bank.district.district_id, bank.transaction1.trans_id, sum(bank.transaction1.amount) as totalTransaction

from bank.transaction1,bank.district ,bank.account,bank.disposition
where 
 bank.transaction1.account_id = bank.account.account_id and
 bank.district.district_id = bank.account.district_id and
 bank.disposition.account_id = bank.account.account_id
 group by bank.transaction1.account_id,bank.disposition.client_id,bank.district.district_id,bank.transaction1.trans_id
 having count(*)>0
 order by bank.transaction1.account_id

### 2. Date Query
>use banksystem
select distinct
bank.transaction1.trans_id AS dayID,

CAST(DATEPART(DAY,convert (date, convert(char(10), bank.transaction1.date1))) AS VARCHAR(2)) as Day,
CAST(DATEPART(MONTH,convert (date, convert(char(10), bank.transaction1.date1))) AS VARCHAR(2)) as Month,
CAST(DATEPART(YEAR,convert (date, convert(char(10), bank.transaction1.date1))) AS VARCHAR(4)) as Year

from banksystem.bank.transaction1

### 3. Account Query
>use banksystem
select bank.account.account_id, bank.account.date1 as openingDate, bank.card.type as card_type, 
bank.disposition.type as dispositionType, bank.card.issued
from bank.account,bank.disposition,bank.card
where bank.disposition.account_id=bank.account.account_id
and bank.disposition.disp_id= bank.card.card_id

### 4. Customer Query
>use banksystem
select bank.client.client_id, bank.client.birth_number from bank.client

### 5. District Query
>use banksystem

select *

from

bank.district