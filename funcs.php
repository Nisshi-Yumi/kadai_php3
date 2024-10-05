<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()

function db_conn(){
  
    try {
        $db_name = '';
        $db_host = '';
        $db_id = '';
        $db_pw = ''; 
    
        /*$db_name = 'gs_db';
        $db_id = 'root';
        $db_pw = '';
        $db_host = 'localhost'; */
        
      
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
            } catch (PDOException $e) {
        exit('DB_CONNECT:'.$e->getMessage());
      }
    }

    //SQLエラー関数：sql_error($stmt)
    function sql_error($stmt){
    $error= $stmt->errorInfo();
    exit("SQLERROR:".$error[2]);
  }

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
  header("Location: ".$file_name);
exit();
}