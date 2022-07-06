<?php
require_once "functions.php";
if(empty($_GET['productId'])){
    echo "商品IDを指定してください";
    exit;
}
if(!preg_match('/\A\d{1,11}\z/u',$_GET['productId'])){
    echo "商品IDを正しく指定してください";
    exit;
}

$productId=(int) $_GET['productId'];

var_dump($productId);

$dbh=db_open();
$sql="SELECT 
productId,
categoryId,
category.category,
productName,
productPrice,
src,
comment
from product inner join category using(categoryId)
where productId=:productId
";

$stmt=$dbh->prepare($sql);
$stmt->bindParam(":productId",$productId,PDO::PARAM_INT);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$result){
    echo "指定したデータはありません";
    exit;
}
var_dump($result);

$productId=str2html($result['productId']);
$categoryId=str2html($result['categoryId']);
$category=str2html($result['category']);
$productName=str2html($result['productName']);
$productPrice=str2html($result['productPrice']);
$comment=str2html($result['comment']);



$html_form=<<<EOD
<form action="product_update.php" method="post">
<p>
    <label for='categoryId'> カテゴリID:</label>
    <select name='categoryId'>
        <option value="8001">牛乳</option>
        <option value="8002">バター</option>
        <option value="8003">ヨーグルト</option>
    </select>
</p>
<p>
    <label for='productName'> 商品名:</label>
    <input type="text" name="productName" id="" value="$productName">
</p>
<p>
    <label for='productPrice'> 価格(円):</label>
    <input type="text" name="productPrice" id="" value="$productPrice">
</p>
<p>
    <label for='src'> 商品画像:</label>
    <select name='src'>
        <option value="images/milk.png">牛乳</option>
        <option value="images/butter.png">バター</option>
        <option value="images/yorgurt.png">ヨーグルト</option>
    </select>
</p>
<p>
    <label for='comment'> コメント:</label>
    <input type="text" name="comment" id="" value="$comment">
</p>
<p>
    <label for='productID'> 商品ID（4桁、1000番台）:</label>
    <input type="text" name="productId" id="" value="$productId">
</p>


<p>
    <input type="hidden" name="productId" id="" value="$productId">
</p>






<input type="submit" value="修正する" class="add_btn">

</form>
EOD;
echo $html_form;