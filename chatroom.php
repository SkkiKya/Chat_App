<?php


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
      <ul class="messages" v-for="item in list">
    <li class="left-side">
        <div class="pic">
          <img src="img/cat.png">
        </div>
        <div class="text">
        {{item.message}}
        </div>
      </li>
      </ul>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="js/main.js"></script>
</body>
</html>