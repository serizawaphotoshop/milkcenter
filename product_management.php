<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product管理用ページ</title>
    <link rel="stylesheet" href="style2.css">
</head>

    <?php include __DIR__.'/inc/header.php';?>
    <div id="main">
        <div id="content">
            <h1>product管理用ページ</h1>
            <div id="add">
                <h2>取扱商品追加</h2>
                <form action="product_add.php" method="post">
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
                    <label for='productID'> 商品ID（4桁、1000番台）:</label>
                    <input type="text" name="productId" id="">
                </p>
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
                <!-- <p>
                    <label for='updateDate'> 追加日(yy-mm-dd):</label>
                    <input type="text" name="updateDate" id="">
                </p> -->
                <!-- <p>
                    <label for='productPrice'> 価格(円):</label>
                    <input type="text" name="productPrice" id="">
                </p> -->
                <!-- <p>
                    <label for='updateUserId'> 管理者ID:</label>
                    <select name='updateUserId'>
                        <option value="2001">織田信長</option>
                        <option value="2002">豊臣秀吉</option>
                        <option value="2003">徳川家康</option>
                    </select>
                </p> -->
                <!-- <p>
                    <label for='updateUser'> 管理者:</label>
                    <select name='updateUser'>
                        <option value="織田信長">織田信長</option>
                        <option value="豊臣秀吉">豊臣秀吉</option>
                        <option value="徳川家康">徳川家康</option>
                    </select>
                </p> -->
                <!-- <p>
                    <label for='stockQuantity'> 在庫数:</label>
                    <input type="text" name="stockQuantity" id="">
                </p>
                <p>
                    <label for='expiryDate'> 賞味期限(yy-mm-dd):</label>
                    <input type="text" name="expiryDate" id="">
                </p> -->







                <input type="submit" value="送信する" class="add_btn">

                </form>
            </div>
            <div class="listbox">
                <h2>取扱商品情報修正</h2>
                <?php require_once 'functions.php';
                try{
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
                ";
                $statement=$dbh->query($sql);
                ?>
                                <div id="container">
                                <?php while($row=$statement->fetch()):?>
                                    <div class="itembox management_itembox">
                                <div class="box-left">
                                <p><?php echo str2html($row[2])?></p>
                                <img src="<?php echo str2html($row[5])?>">
                                </div>
                                <div class="box-right">
                                <h2><?php echo str2html($row[3])?></h2>
                                <span>価格：<?php echo str2html($row[4])?>円</span>
                                <span>商品ID:<?php echo str2html($row[0])?></span>
                                <span>コメント：<?php echo str2html($row[6])?></span>

            
            
            
                                <p class="fix"><a href="product_edit.php?productId=<?php echo (int) $row[0];?>">修正</a></p>
                                <p class="delete"><a href="">削除</a></p>
                            </div>
                            </div>
                            <?php endwhile;?>
                        </div></div>
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