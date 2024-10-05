<?php

//１．POSTデータ取得
$name = $_POST["name"] ;
$email = $_POST["email"] ;
$eco_bag = isset($_POST["eco_bag"]) ? 1 : 0;
$my_bottle = isset($_POST["my_bottle"]) ? 1 : 0;
$walking_bike = isset($_POST["walking_bike"]) ? 1 : 0;
$power_bike = isset($_POST["power_bike"]) ? 1 : 0;

// 2.DB接続
//funcion化
include("funcs.php"); //外部ファイル読みこみ   
$pdo=db_conn();


// 3.データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table (name, email, eco_bag, my_bottle, walking_bike, power_bike) 
                VALUES (:name, :email, :eco_bag, :my_bottle, :walking_bike, :power_bike)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':eco_bag', $eco_bag, PDO::PARAM_INT);
$stmt->bindValue(':my_bottle', $my_bottle, PDO::PARAM_INT);
$stmt->bindValue(':walking_bike', $walking_bike, PDO::PARAM_INT);
$stmt->bindValue(':power_bike', $power_bike, PDO::PARAM_INT);
$status = $stmt->execute(); // 実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  //*** function化する！*****************

  redirect("select.php");
}
?>
