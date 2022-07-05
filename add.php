<?php
var_dump($_POST) ;
// echo $_POST['categoryId'];
require_once 'functions.php';
$user="root";
$password="";
$opt=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES=>false,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS=>false,
];
$dbh=new PDO('mysql:host=localhost;dbname=milkcenter',$user,$password,$opt);
$sql="INSERT into product (productId,categoryId,productName,productPrice,src,comment) values
(:productId,:categoryId,:productName,:productPrice,:src,:comment);
INSERT into category (categoryId,category)values (:categoryId,:category);
INSERT into updateUser values(:updateUserId,:updateUser);
INSERT into master (id,productId,updateDate,updateUserId,stockQuantity,expiryDate) values(null,:productId,:updateDate,:updateUserId,:stockQuantity,:expiryDate)";
$stmt=$dbh->prepare($sql);
var_dump($stmt);