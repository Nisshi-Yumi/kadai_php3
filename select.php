<?php
//funcion化

include("funcs.php"); //外部ファイル読みこみ   
$pdo=db_conn();


//２．データ登録SQL作成
$sql = "SELECT * FROM gs_an_table";
$stmt = $pdo->query($sql);
//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    //$error = $stmt->errorInfo();
    //exit("SQLError:".$error[2]);
    sql_error($stmt);
  }


  //全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>アンケート結果</title>
</head>
<body>
    <h1>アンケート結果一覧</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>id</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>エコバッグを使っている</th>
            <th>マイボトルを使っている</th>
            <th>自転車や徒歩で移動している</th>
            <th>発電バイクで運動したい</th>
            <th>評価</th> <!-- 新たに評価（★）を追加 -->
        </tr>

       
        <?php if (count($values) > 0): ?>
            <?php foreach ($values as $row): ?>
                <?php
                // 「はい」と答えた数をカウント
                $star_count = $row['eco_bag'] + $row['my_bottle'] + $row['walking_bike'] + $row['power_bike'];
                $stars = str_repeat('★', $star_count); // ★の数を決定
                ?>
                <tr>
                    <td><?= h($row['id'], ) ?></td>
                    <td><?= h($row['name'], ) ?></td>
                    <td><?= h($row['email'],  ) ?></td>
                    <td><?= h($row['eco_bag'] ? 'はい' : 'いいえ' )?></td>
                    <td><?= h($row['my_bottle'] ? 'はい' : 'いいえ') ?></td>
                    <td><?= h($row['walking_bike'] ? 'はい' : 'いいえ') ?></td>
                    <td><?= h($row['power_bike'] ? 'はい' : 'いいえ' )?></td>
                    <td><?= $stars ?></td> <!-- 評価として★を表示 -->
                    <td><a href="detail.php?id=<?= h($row['id'], ) ?>">更新</a> </td>
                    <td><a href="delete.php?id=<?= h($row['id'], ) ?>">削除</a> </td>
                </tr>
                
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">データがありません。</td>
            </tr>
        <?php endif; ?>
    </table>
</body
