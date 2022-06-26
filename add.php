<?php
require_once 'functions.php';


if(empty($_POST['title'])){
    echo "タイトルは必須です";
    exit;
}
if(!preg_match('/\A[[:^cntrl:]]{1,200}\z/u',$_POST['title'])){
    echo 'タイトルは200文字までです。';
    exit;
}
if(!preg_match('/\A\d{0,13}\z/u',$_POST['isbn'])){
    echo "ISBNは13桁までです";
    exit;
}
if(!preg_match('/\A\d{0,6}\z/u',$_POST['price'])){
    echo "価格は6桁までです。";
    exit;
}
if(empty($_POST['publish'])){
    echo "日付は必須です。";
    exit;
}
if(!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u',$_POST['publish'])){
    echo "日付のフォーマットが違います";
    exit;
}

$date=explode('-',$_POST['publish']);
if(!checkdate($date[1],$date[2],$date[0])){
    echo "正しい日付を入力してください。";
    exit;
}

if(!preg_match('/\A[[:^cntrl:]]{0,80}\z/u',$_POST['author'])){
    echo "著者名は80文字で入力してください";
    exit;
}


try{
    // $user="root";
    // $password="";
    // $opt=[
    //     PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    //     PDO::ATTR_EMULATE_PREPARES=>false,
    //     PDO::MYSQL_ATTR_MULTI_STATEMENTS=>false,
    // ];
    
    // $dbh=new PDO('mysql:host=localhost;dbname=sample_db',$user,$password,$opt);
    $dbh=db_open();
    $sql ='INSERT INTO books (id,title,isbn,price,publish,author)values (null ,:title,:isbn,:price,:publish,:author)';
    
    $stmt=$dbh->prepare($sql);
    
    $price=(int)$_POST['price'];
    $stmt->bindParam(":title",$_POST['title'],PDO::PARAM_STR);
    $stmt->bindParam(":isbn",$_POST['isbn'],PDO::PARAM_STR);
    $stmt->bindParam(":price",$price,PDO::PARAM_INT);
    $stmt->bindParam(":publish",$_POST['publish'],PDO::PARAM_STR);
    $stmt->bindParam(":author",$_POST['author'],PDO::PARAM_STR);
    
    $stmt->execute();
    echo "データが追加されました。<br>";
    echo "<a href=\"list.php\">リストへ戻る</a>";
}catch(PDOException $e){
    echo "エラー：".str2html($e->getMessage())."<br>";
    exit;
}