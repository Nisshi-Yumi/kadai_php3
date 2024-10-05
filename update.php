<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更


//１．POSTデータ取得
$id = $_POST["id"] ;
$name = $_POST["name"] ;
$email = $_POST["email"] ;
$eco_bag = isset($_POST["eco_bag"]) ? 1 : 0;
$my_bottle = isset($_POST["my_bottle"]) ? 1 : 0;
$walking_bike = isset($_POST["walking_bike"]) ? 1 : 0;
$power_bike = isset($_POST["power_bike"]) ? 1 : 0;

// 2.DB接続
include("funcs.php"); //外部ファイル読みこみ   
$pdo=db_conn();


// 3.データ登録SQL作成
$sql = "UPDATE gs_an_table SET name=:name,email=:email,eco_bag=:eco_bag,my_bottle=:my_bottle,walking_bike=:walking_bike,power_bike=:power_bike WHERE id=:id";
$stmt = $pdo->prepare($sql) ;
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':eco_bag', $eco_bag, PDO::PARAM_INT);
$stmt->bindValue(':my_bottle', $my_bottle, PDO::PARAM_INT);
$stmt->bindValue(':walking_bike', $walking_bike, PDO::PARAM_INT);
$stmt->bindValue(':power_bike', $power_bike, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); // 実行


//４．データ登録SQL作成
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}

?>
