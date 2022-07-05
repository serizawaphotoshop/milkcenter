<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理用ページ</title>
    <link rel="stylesheet" href="style2.css">
</head>

<!--<body>
    <div id="header">
        <ul>
        <h1><img src="images/logo.svg"></h1>
        <li><a href="management.php">管理用</a></li>
        <li>お客様ガイド</li>
        <li>会員登録</li>
        <li>よくある質問</li>
        <li>お問い合わせ</li>
        </ul>
    </div> -->
    <?php include __DIR__.'/inc/header.php';?>
    <!-- <div id="heroimg-wrapper">
        <div id="heroimg">

        </div>
    </div> -->
    <div id="main">
        <div id="content">
            <h1>管理用ページ</h1>
            <!-- <div id="shop">
                <input type="button" value="元に戻す" class="menubtn" onclick="">
                <input type="button" value="賞味期限順にする" class="menubtn" onclick="printExpirySort()">
                <input type="button" value="まとめて購入" class="menubtn" onclick="">
                <div class="toggle-switch">
                    <input id="check" class="toggle-input" type='checkbox' />
                    <label for="check" class="toggle-label">
                </div>
                <p>安売りモード</p>
            </div> -->
            <div id="add">
                <form action="add.php" method="post">
                <p>
                    <label for='categoryId'> カテゴリID:</label>
                    <select name='categoryId'>
                        <option value="8001">8001</option>
                        <option value="8002">8002</option>
                        <option value="8003">8003</option>
                    </select>
                </p>
                <p>
                    <label for='category'> カテゴリ:</label>
                    <select name='category'>
                        <option value="牛乳">牛乳</option>
                        <option value="バター">バター</option>
                        <option value="ヨーグルト">ヨーグルト</option>
                    </select>
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
                <p>
                    <label for='productID'> 商品ID（4桁、1000番台）:</label>
                    <input type="text" name="productId" id="">
                </p>
                <p>
                    <label for='updateDate'> 追加日(yy-mm-dd):</label>
                    <input type="text" name="updateDate" id="">
                </p>
                <p>
                    <label for='productPrice'> 価格(円):</label>
                    <input type="text" name="productPrice" id="">
                </p>
                <p>
                    <label for='updateUserId'> 管理者ID:</label>
                    <select name='updateUserId'>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                    </select>
                </p>
                <p>
                    <label for='updateUser'> 管理者:</label>
                    <select name='updateUser'>
                        <option value="織田信長">織田信長</option>
                        <option value="豊臣秀吉">豊臣秀吉</option>
                        <option value="徳川家康">徳川家康</option>
                    </select>
                </p>
                <p>
                    <label for='stockQuantity'> 在庫数:</label>
                    <input type="text" name="stockQuantity" id="">
                </p>
                <p>
                    <label for='expiryDate'> 賞味期限(yy-mm-dd):</label>
                    <input type="text" name="expiryDate" id="">
                </p>







                <input type="submit" value="送信する">

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
                <div id="container">
                    <?php while($row=$statement->fetch()):?>
                        <div class="itembox">
                    <div class="box-left">
                    <p><?php echo str2html($row[2])?></p>
                    <img src="<?php echo str2html($row[10])?>">
                    </div>
                    <div class="box-right">
                    <h2><?php echo str2html($row[3])?></h2>
                    <span>価格：<?php echo str2html($row[4])?>円</span>
                    <p><?php echo str2html($row[9])?></p>
                    <p><a href="">編集</a></p>
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