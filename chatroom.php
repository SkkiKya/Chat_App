<?php
require 'funcs.php';

// DB接続
$pdo = connect_db();

$task = array();

$sql = "select * from chat where life != 'deleted'";
 $stmt = $pdo->prepare($sql);
 $status = $stmt->execute();

 // データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  // データ登録時，失敗で以下を表示
  exit('sqlError:'.$error[2]);
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
// fetchAll()関数でSQLで取得したレコードを配列で取得できる
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($results);
// exit();
}
// $id=2;
// $room_id = $_SESSION['roomId'];
$roomId = 1;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>CSS Chat</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div id="app">
    <form action="" class="add-form" @submit.prevent="add">
      <!-- message -->
      <input type="text" name="chat" ref="message">
      <!-- button -->
      <button type="button" class="done" @click="send_message">送信</button>
    </form>
  
    <!-- フォーム -->
    <div class="container">
      <ul class="messages">
        <?php foreach($results as $result): ?>
    <li class="left-side">
        <div class="pic">
          <!-- <img src="img/.png" alt="no image"> -->
          <!-- <?=$result['user_id'] ?> -->
          <?= img_tag($result['user_id']); ?>
        </div>
        <div class="text">
          <?=h($result['chat']);?>
        </div>
      </li>
      <?php endforeach ?>
      </ul>
      <ul class="messages"  v-for="item in list">
      <li class="left-side">
        <div class="pic">
          <img src="img/2.png">
        </div>
        <div class="text">
          {{item.message}}
        </div>
      </li>
      </ul>
    </div>
  </div>
  <!-- Vue.jsのCDN -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- #CDNのaxios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
<script>
  (function(){
  'use strict';
 var vm = new Vue ({
    el: '#app',
    data: {
        list: [],
    },
    methods: {
      send_message: function(event, value) {
       var message = this.$refs.message
       if(!message.value.length){
         return
       }
       this.list.push({
         message: message.value,
       })
      let params = new URLSearchParams();
      params.append('u_id', 2);//セッションでとった値
      params.append('message', message.value);
      params.append('r_id', <?= $roomId ?>);
       console.log(params);
    axios
     .post('_ajax_add_chat.php', params)
     .then(function(rs){
      //  送信をクリックすると値を書き換える＋表示に反映される
      console.log(rs.data);

      message.value=''
     })
     .catch(error => (this.error = error))

      }
    }

  })
})();
</script>
</body>
</html>