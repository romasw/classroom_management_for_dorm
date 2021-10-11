<?php
require('header.php');
$classroom = $_GET['classroom'];
$in_out = $_GET['in_out'];
switch($classroom){
  case 1:
    $room="大教室";
    break;
  case 2:
    $room="視聴覚室";
    break;
  case 3:
    $room="マルチメディア教室";
    break;
  case 4:
    $room="セミナー・交流スペース";
    break;
}
if($in_out==0){
  $or = "に入室";
}else{
  $or = "から退室";
}
?>
<body>
  <div class="footerFixed">
    <h1>寮生用教室入退室管理システム</h1>
    <h2><?php echo $room . $or . "しました"; ?></h2>
    <section>
      <a href="index.php" class="btn_02">ホームへ戻る</a>
    </section>
    <footer>(c)Roma Tsutsumi</footer>
  </div>
</body>
</html>