<?php


require('funcs.php');

$pdo = connect_db();

$u_id = $_POST['u_id'];
$message = $_POST['message'];
$r_id = $_POST['r_id'];

$sql = "INSERT INTO `chat`(`id`,`user_id`, `chat`, `life`, `created_at`, `updated_at`, `room_id`) VALUES (null, :u_id, :message, 'exist',sysdate(), sysdate(), :r_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":u_id", $u_id, PDO::PARAM_INT);
    $stmt->bindValue(":message", $message, PDO::PARAM_STR_CHAR);
    $stmt->bindValue(":r_id", $r_id, PDO::PARAM_INT);
    $status = $stmt->execute();
// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  // データ登録時，失敗で以下を表示
  exit('sqlError:'.$error[2]);
} else {
  echo $pdo->lastInsertId();
}