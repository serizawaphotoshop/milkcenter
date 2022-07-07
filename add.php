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
// if(empty($_POST['categoryId'])){
//     echo "カテゴリは必須です";
//     exit;
// }
// if(empty($_POST['productName'])){
//     echo "商品名は必須です";
//     exit;
// }
// if(!preg_match('/\A[[:^cntrl:]]{1,50}\z/u',$_POST['productName'])){
//     echo "商品名を正しく入力してください";
//     exit;
// }
// if(empty($_POST['productPrice'])){
//     echo "価格は必須です";
//     exit;
// }
// if(!preg_match('/\A\d{1,10}\z/u',$_POST['productPrice'])){
//     echo "価格を正しく入力してください";
//     exit;
// }
// if(empty($_POST['comment'])){
//     echo "コメントは必須です";
//     exit;
// }
// if(!preg_match('/\A[[:^cntrl:]]{1,1000}\z/u',$_POST['comment'])){
//     echo "コメントの文字数が多すぎます";
//     exit;
// }
if(empty($_POST['updateDate'])){
    echo "追加日は必須です";
    exit;
}
if(!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u',$_POST['updateDate'])){
    echo "日付のフォーマットが違います。";
    exit;
}
$updateDate=explode('-',$_POST['updateDate']);
if(!checkdate($updateDate[1],$updateDate[2],$updateDate[0])){
    echo "正しい日付を入力してください。";
    exit;
}
if(empty($_POST['stockQuantity'])){
    echo "在庫は必須です";
    exit;
}
if(!preg_match('/\A\d{1,11}\z/u',$_POST['stockQuantity'])){
    echo "在庫を正しく入力してください";
    exit;
}
if(empty($_POST['expiryDate'])){
    echo "消費期限は必須です";
    exit;
}
if(!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u',$_POST['expiryDate'])){
    echo "日付のフォーマットが違います。";
    exit;
}
$expiryDate=explode('-',$_POST['expiryDate']);
if(!checkdate($expiryDate[1],$expiryDate[2],$expiryDate[0])){
    echo "正しい日付を入力してください。";
    exit;
}





$dbh=db_open();




$sql="INSERT into master(id,productId,updateDate,updateUserId,stockQuantity,expiryDate)
values(null,:productId,:updateDate,:updateUserId,:stockQuantity,:expiryDate);";

$stmt=$dbh->prepare($sql);


$stmt->bindParam(":productId",$_POST['productId'],PDO::PARAM_INT);
$stmt->bindParam(":updateDate",$_POST['updateDate'],PDO::PARAM_STR);
$stmt->bindParam(":updateUserId",$_POST['updateUserId'],PDO::PARAM_INT);
$stmt->bindParam(":stockQuantity",$_POST['stockQuantity'],PDO::PARAM_INT);
$stmt->bindParam(":expiryDate",$_POST['expiryDate'],PDO::PARAM_INT);

$stmt->execute();

echo "データが追加されました<br>";
echo "<a href=\"management.php\">管理用ページに戻る</a>";