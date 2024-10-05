<?php
$id = $_GET["id"];
//funcion化

include("funcs.php"); //外部ファイル読みこみ   
$pdo=db_conn();
// MySQL接続情報


//２．データ登録SQL作成
$sql = "SELECT * FROM gs_an_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    //$error = $stmt->errorInfo();
    //exit("SQLError:".$error[2]);
    sql_error($stmt);
  }


  //全データ取得
  $values = $stmt->fetch(); // 1行だけ取得する場合

//$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>脱炭素アクションアンケート更新</title>
</head>
<body>
    <h1>脱炭素アクションアンケート更新</h1>
    <form method="POST" action="update.php">
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" required value="<?=$values["name"]?>"><br><br>

        <label for="email">メールアドレス:</label>
        <input type="email" name="email" id="email" required value="<?=$values["email"]?>"><br><br>

        <label>
            <input type="checkbox" name="eco_bag" value="1" <?= $values["eco_bag"] ? 'checked' : '' ?>> エコバッグを使っている
        </label><br>
        <label>
            <input type="checkbox" name="my_bottle" value="1" <?= $values["my_bottle"] ? 'checked' : '' ?>> マイボトルを使っている
        </label><br>
        <label>
            <input type="checkbox" name="walking_bike" value="1"  <?= $values["walking_bike"] ? 'checked' : '' ?>>  自転車や徒歩で移動している
        </label><br>
        <label>
            <input type="checkbox" name="power_bike" value="1" <?= $values["power_bike"] ? 'checked' : '' ?>> 発電バイクがあれば運動して発電する
            <input type="hidden" name="id" value="<?=$values["id"]?>"> 
        </label><br><br>

        <button type="submit">送信</button>
    </form>
</body>
</html>
