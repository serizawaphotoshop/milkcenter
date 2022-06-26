<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript総合問題</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div id="header">
        <ul>
        <h1><img src="images/logo.svg"></h1>
        <li>商品一覧</li>
        <li>お客様ガイド</li>
        <li>会員登録</li>
        <li>よくある質問</li>
        <li>お問い合わせ</li>
        </ul>
    </div>
    <div id="heroimg-wrapper">
        <div id="heroimg">

        </div>
    </div>
    <div id="main">
        <div id="content">
            <div id="shop">
                <input type="button" value="元に戻す" class="menubtn" onclick="">
                <input type="button" value="賞味期限順にする" class="menubtn" onclick="printExpirySort()">
                <input type="button" value="まとめて購入" class="menubtn" onclick="">
                <div class="toggle-switch">
                    <input id="check" class="toggle-input" type='checkbox' />
                    <label for="check" class="toggle-label">
                </div>
                <p>安売りモード</p>
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
                <div class="itembox">
                    <?php while($row=$statement->fetch()):?>
                    <div class="box-left">
                    <p><?php echo str2html($row[2])?></p>
                    <img src="<?php echo str2html($row[10])?>">
                    </div>
                    <div class="box-right">
                    <h2><?php echo str2html($row[3])?></h2>
                    <span>価格：<?php echo str2html($row[4])?>円</span>
                    <form>
                        <label for="Purchase-number">個数</label>
                        <input type="text" class="Purchase-number" id="Purchase-number<?php echo str2html($row[0])?>" name="Purchase-number">
                        <input class="btn" type="submit" onclick="" value="購入する">
                    </form>
                    <p><?php echo str2html($row[9])?></p>
                    </div>
                <?php endwhile;?>
                </div>



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