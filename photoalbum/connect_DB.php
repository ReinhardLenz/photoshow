<?php
$host='xx';
$user='xx';
$password='xx';
$dbname='xx';
/*
$host='xx';
$user='xx';
$password='xx';
$dbname='xx';
*/

$dsn='mysql:host='.$host.';dbname='.$dbname;
$pdo=new PDO($dsn,$user,$password);

if (!$pdo){
    die(mysqli_error($pdo));
}