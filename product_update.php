<?php
require_once 'functions.php';

if(empty($_POST['productId'])){
    echo "商品IDは必須です";
    exit;
}
if(!preg_match('/\A\d{1,11}\z/u',$_POST['productId'])){
    echo "商品IDを正しく入力してください";
    exit;
}
if(empty($_POST['categoryId'])){
    echo "カテゴリは必須です";
    exit;
}
if(empty($_POST['productName'])){
    echo "商品名は必須です";
    exit;
}
if(!preg_match('/\A[[:^cntrl:]]{1,50}\z/u',$_POST['productName'])){
    echo "商品名を正しく入力してください";
    exit;
}
if(empty($_POST['productPrice'])){
    echo "価格は必須です";
    exit;
}
if(!preg_match('/\A\d{1,10}\z/u',$_POST['productPrice'])){
    echo "価格を正しく入力してください";
    exit;
}
if(empty($_POST['comment'])){
    echo "コメントは必須です";
    exit;
}
if(!preg_match('/\A[[:^cntrl:]]{1,1000}\z/u',$_POST['comment'])){
    echo "コメントの文字数が多すぎます";
    exit;
}


$dbh=db_open();
$sql="UPDATE product set categoryId=:categoryId,productName=:productName,productPrice=:productPrice,src=:src,comment=:comment where productId=:productId";

$stmt=$dbh->prepare($sql);

$stmt->bindParam(":productId",$_POST['productId'],PDO::PARAM_INT);
$stmt->bindParam(":categoryId",$_POST['categoryId'],PDO::PARAM_INT);
$stmt->bindParam(":productName",$_POST['productName'],PDO::PARAM_STR);
$stmt->bindParam(":productPrice",$_POST['productPrice'],PDO::PARAM_INT);
$stmt->bindParam(":src",$_POST['src'],PDO::PARAM_STR);
$stmt->bindParam(":comment",$_POST['comment'],PDO::PARAM_STR);

$stmt->execute();

echo "データが更新されました<br>";
echo "<a href=\"product_management.php\">管理用ページに戻る</a>";

