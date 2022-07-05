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
$sql="INSERT all into product (productId,categoryId,productName,productPrice,src,comment) values
(:productId,:categoryId,:productName,:productPrice,:src,:comment)
into category (categoryId,category)
values (:categoryId,:category)
into updateUser 
values(:updateUserId,:updateUser)
into master (id,productId,updateDate,updateUserId,stockQuantity,expiryDate)
values(null,:productId,:updateDate,:updateUserId,:stockQuantity,:expiryDate)";
$stmt=$dbh->prepare($sql);
var_dump($stmt);

// insert all into product (productId,categoryId,productName,productPrice,src,comment) values(1004,8003,'ブルガリアヨーグルト',200,'images/yorgurt.png','おいしい')
// into category (categoryId,category) values (8003,'ヨーグルト')
// into updateUser values(2001,'織田信長');
// into master(id,productId,updateDate,updateUserId,stockQuantity,expiryDate) values(null,1004,'2021-10-01',2001,50,'2021-11-20');