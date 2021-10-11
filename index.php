<?php require('./header.php'); ?>
<body>
  <div class="footerFixed">
    <h1>寮生用教室入退室管理システム</h1>
    <section class="in">
        <a href="in.php">
        <img src="/img/2512728.png"   width=200px>
        <h1>入室</h1>
      </a>
    </section>
    <section class="out">
        <a href="out.php">
        <img src="/img/2512730.png"   width=200px>
        <h1>退室</h1>
      </a>
    </section>
    <section class="current">
      <a href="status.php" class="btn_03">各教室の状況</a>
    </section>
    <section class="current">
      <a href="./data/list.php" class="btn_03">管理者ログイン</a>
    </section>
    <footer>(c)Roma Tsutsumi</footer>
  </div>
</body>
</html>