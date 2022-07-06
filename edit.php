<?php
require_once "functions.php";
if(empty($_GET['id'])){
    echo "IDを指定してください";
    exit;
}
if(!preg_match('/\A\d{1,11}\z/u',$_GET['id'])){
    echo "IDを正しく指定してください";
    exit;
}

$id=(int) $_GET['id'];
// var_dump($id);
$dbh=db_open();
$sql="SELECT
            id,
            productId,
            category.category,
            product.productName,
            product.productPrice,
            updateDate,
            updateUser.updateUser,
            stockQuantity,
            expiryDate,
            product.comment,
            product.src
        from master
        inner join updateUser using(updateUserId)
        inner join product using(productId)
        inner join category using(categoryId)
    where id=:id
";

$stmt=$dbh->prepare($sql);
$stmt->bindParam(":id",$id,PDO::PARAM_INT);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$result){
    echo "指定したデータはありません";
    exit;
}
var_dump($result);

$productName=str2html($result['productName']);
$productPrice=str2html($result['productPrice']);
$comment=str2html($result['comment']);
$productId=str2html($result['productId']);
$updateDate=str2html($result['updateDate']);
$stockQuantity=str2html($result['stockQuantity']);
$expiryDate=str2html($result['expiryDate']);
$id=str2html($result['id']);















$html_form=<<<EOD
<form action="update.php" method="post">
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
    <label for='updateDate'> 追加日(yy-mm-dd):</label>
    <input type="text" name="updateDate" id="" value="$updateDate">
</p>

<p>
    <label for='updateUserId'> 管理者ID:</label>
    <select name='updateUserId'>
        <option value="2001">織田信長</option>
        <option value="2002">豊臣秀吉</option>
        <option value="2003">徳川家康</option>
    </select>
</p>

<p>
    <label for='stockQuantity'> 在庫数:</label>
    <input type="text" name="stockQuantity" id="" value="$stockQuantity">
</p>
<p>
    <label for='expiryDate'> 賞味期限(yy-mm-dd):</label>
    <input type="text" name="expiryDate" id="" value="$expiryDate">
</p>
<p>
    <input type="hidden" name="id" id="" value="$id">
</p>






<input type="submit" value="送信する" class="add_btn">

</form>
EOD;
echo $html_form;