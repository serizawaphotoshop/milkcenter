<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理用ページ</title>
    <link rel="stylesheet" href="style2.css">
</head>

    <?php include __DIR__.'/inc/header.php';?>
    <div id="main">
        <div id="content">
            <h1>管理用ページ</h1>
            <div id="add">
                <h2>商品追加</h2>
                <form action="add.php" method="post">
                <p>
                    <label for='categoryId'> カテゴリID:</label>
                    <select name='categoryId'>
                        <option value="8001">牛乳</option>
                        <option value="8002">バター</option>
                        <option value="8003">ヨーグルト</option>
                    </select>
                </p>
                <!-- <p>
                    <label for='category'> カテゴリ:</label>
                    <select name='category'>
                        <option value="牛乳">牛乳</option>
                        <option value="バター">バター</option>
                        <option value="ヨーグルト">ヨーグルト</option>
                    </select>
                </p> -->
                <p>
                    <label for='productName'> 商品名:</label>
                    <input type="text" name="productName" id="">
                </p>
                <p>
                    <label for='productPrice'> 価格(円):</label>
                    <input type="text" name="productPrice" id="">
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
                    <input type="text" name="comment" id="">
                </p>
                <p>
                    <label for='productID'> 商品ID（4桁、1000番台）:</label>
                    <input type="text" name="productId" id="">
                </p>
                <p>
                    <label for='updateDate'> 追加日(yy-mm-dd):</label>
                    <input type="text" name="updateDate" id="">
                </p>
                <!-- <p>
                    <label for='productPrice'> 価格(円):</label>
                    <input type="text" name="productPrice" id="">
                </p> -->
                <p>
                    <label for='updateUserId'> 管理者ID:</label>
                    <select name='updateUserId'>
                        <option value="2001">織田信長</option>
                        <option value="2002">豊臣秀吉</option>
                        <option value="2003">徳川家康</option>
                    </select>
                </p>
                <!-- <p>
                    <label for='updateUser'> 管理者:</label>
                    <select name='updateUser'>
                        <option value="織田信長">織田信長</option>
                        <option value="豊臣秀吉">豊臣秀吉</option>
                        <option value="徳川家康">徳川家康</option>
                    </select>
                </p> -->
                <p>
                    <label for='stockQuantity'> 在庫数:</label>
                    <input type="text" name="stockQuantity" id="">
                </p>
                <p>
                    <label for='expiryDate'> 賞味期限(yy-mm-dd):</label>
                    <input type="text" name="expiryDate" id="">
                </p>







                <input type="submit" value="送信する" class="add_btn">

                </form>
            </div>
            <div>
                <?php require_once 'functions.php';
                    try{
                        $user="root";
                        $password="";
                        $opt=[
                            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_EMULATE_PREPARES=>false,
                            PDO::MYSQL_ATTR_MULTI_STATEMENTS=>false
                        ];
                        $dbh=new PDO('mysql:host=localhost;dbname=milkcenter',$user,$password,$opt);
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
                                    inner join category using(categoryId);";
                                    $statement=$dbh->query($sql);
                                    ?>
                    <h2>商品情報修正</h2>
                <div id="container">
                    <?php while($row=$statement->fetch()):?>
                        <div class="itembox management_itembox">
                    <div class="box-left">
                    <p><?php echo str2html($row[2])?></p>
                    <img src="<?php echo str2html($row[10])?>">
                    </div>
                    <div class="box-right">
                    <h2><?php echo str2html($row[3])?></h2>
                    <span>価格：<?php echo str2html($row[4])?>円</span>
                    <span>追加：<?php echo str2html($row[5])?></span>
                    <span>管理者：<?php echo str2html($row[6])?></span>
                    <span>在庫：<?php echo str2html($row[7])?></span>
                    <span>消費期限：<?php echo str2html($row[8])?></span>




                    <p><?php echo str2html($row[9])?></p>
                    <p class="fix"><a href="edit.php?id=<?php echo (int) $row[0];?>">修正</a></p>
                    <p class="delete"><a href="">削除</a></p>
                </div>
                </div>
                <?php endwhile;?>



                </div>
</div>
</div>
</div>
    <?php
}catch(PDOException $e){
    echo "エラー" . str2html($e->getMessage());
    exit;
}
?>
    <script type="text/javascript" src="ans.js"></script>
</body>

</html>