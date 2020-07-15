<?PHP
// セッションスタート
session_start();

// データベース接続関数
function connect_db() {
  
  $db = 'mysql';
  $dbname = 'chatRoom';
  $chart = 'utf8';
  $port = '3308';
  $host = 'localhost';
  
  // DB接続の設定
  $dbn = "$db:dbname=$dbname;charset=$chart;port=$port;host=$host";
  $user = 'root';
  $pwd = '';
  // DB接続を確認
  try {
    // ここでDB接続処理を実行する
    $pdo = new PDO($dbn, $user, $pwd);
    return $pdo;
  } catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }  
}

// エスケープ関数
function h($val){
  return htmlspecialchars($val, ENT_QUOTES);
}

// LOGIN認証がされているかチェックする関数
function loginCheck() {
  // sessionIdがなかったり，一致しないと表示する。
if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id() ){
  echo "LOGIN ERROR!";
  exit();
}else {
  // 新しいsessionIdを発行(前のセッションは無効)
session_regenerate_id();
// 新しいsessionIdを取得
$_SESSION["chk_ssid"] = session_id();
// echo "新しいセッションId：{$_SESSION["chk_ssid"]}";
}
}

// 画像を表示する関数
// アップロードした画像がここでコピーされ，表示に使われる
function img_tag($code) {
  if (file_exists("img/$code.png")) {
      $name = $code;
  }else {
      $name ='sample';
  }
  return "<img src='img/$name.png' alt=''>";
}
