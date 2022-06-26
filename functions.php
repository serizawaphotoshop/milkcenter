<?php
function str2html(string $string){
    return htmlspecialchars($string,ENT_QUOTES,'utf-8');
}

function db_open(){
    $user="root";
    $password="";
    $opt=[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES=>false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS=>false,
    ];
    $dbh=new PDO('mysql:host=localhost;dbname=sample_db',$user,$password,$opt);
    return $dbh;
}