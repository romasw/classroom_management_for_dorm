<?php
require('../mysql.php');
$query = "select STUDENT, ENTER_TIME from dai where EXIT_TIME IS NULL";
$result = $mysqli->query($query);
$dai = "";
while($rows = $result->fetch_assoc()){
  $student = $rows["STUDENT"];
  $building = intval(substr(strval($student), 0, 1));
  $room = $student - $building*1000;
  $enter = date('H時i分', strtotime($rows["ENTER_TIME"]));
  switch($building){
    case 1:
      $build = "新";
      break;
    case 2:
      $build = "西";
      break;
    case 3:
      $build = "北";
      break;
    case 4:
      $build = "紫";
      break;
  }
  $dai = $dai . $build . $room . " : " . $enter . "入室<br>";
}

$query = "select STUDENT, ENTER_TIME from shityou where EXIT_TIME IS NULL";
$result = $mysqli->query($query);
$shityou = "";
while($rows = $result->fetch_assoc()){
  $student = $rows["STUDENT"];
  $building = substr($student, 0, 1);
  $room = $student - $building*1000;
  $enter = date('H時i分', strtotime($rows["ENTER_TIME"]));
  switch($building){
    case 1:
      $build = "新";
      break;
    case 2:
      $build = "西";
      break;
    case 3:
      $build = "北";
      break;
    case 4:
      $build = "紫";
      break;
  }
  $shityou = $shityou . $build . $room . " : " . $enter . "入室<br>";
}

$query = "select STUDENT, ENTER_TIME from multi where EXIT_TIME IS NULL";
$result = $mysqli->query($query);
$multi = "";
while($rows = $result->fetch_assoc()){
  $student = $rows["STUDENT"];
  $building = substr($student, 0, 1);
  $room = $student - $building*1000;
  $enter = date('H時i分', strtotime($rows["ENTER_TIME"]));
  switch($building){
    case 1:
      $build = "新";
      break;
    case 2:
      $build = "西";
      break;
    case 3:
      $build = "北";
      break;
    case 4:
      $build = "紫";
      break;
  }
  $multi = $multi . $build . $room . " : " . $enter . "入室<br>";
}

$query = "select STUDENT, ENTER_TIME from seminar where EXIT_TIME IS NULL";
$result = $mysqli->query($query);
$multi = "";
while($rows = $result->fetch_assoc()){
  $student = $rows["STUDENT"];
  $building = substr($student, 0, 1);
  $room = $student - $building*1000;
  $enter = date('H時i分', strtotime($rows["ENTER_TIME"]));
  switch($building){
    case 1:
      $build = "新";
      break;
    case 2:
      $build = "西";
      break;
    case 3:
      $build = "北";
      break;
    case 4:
      $build = "紫";
      break;
  }
  $seminar = $seminar . $build . $room . " : " . $enter . "入室<br>";
}

//人数取得
$query = "select count(student) as cnt from students WHERE classroom=1;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$dai_num = $row["cnt"];
$query = "select count(student) as cnt from students WHERE classroom=2;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$shityou_num = $row["cnt"];
$query = "select count(student) as cnt from students WHERE classroom=3;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$multi_num = $row["cnt"];
$query = "select count(student) as cnt from students WHERE classroom=4;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$seminar_num = $row["cnt"];
?>
<?php date_default_timezone_set('Asia/Tokyo'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>教室入退室管理システム</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="../favicon.ico" />
</head>
<body>
<div class="footerFixed">
  <h1>寮生用教室入退室管理システム</h1>
  <h2>現在の利用者一覧</h2>
  <div class="lists-container">
    <!-- <div class="lists-item" style="height:<?php echo 100 + $dai_num * 25 . "px"; ?>;"><p id="list_room">大教室　<?php echo $dai_num . "/40"; ?></p><p id="child"><?php echo $dai; ?></p></div>
    <div class="lists-item" style="height:<?php echo 100 + $shityou_num * 25 . "px"; ?>;"><p id="list_room">視聴覚室　<?php echo $shityou_num . "/20"; ?></p><p id="child"><?php echo $shityou; ?></p></div>
    <div class="lists-item" style="height:<?php echo 100 + $multi_num * 25 . "px"; ?>;"><p id="list_room">MM教室　<?php echo $multi_num . "/20"; ?></p><p id="child"><?php echo $multi; ?></p></div> -->
   <div class="lists-item" style="height:<?php echo 100 + $seminar_num * 25 . "px"; ?>;"><p id="list_room">セミナー・交流スペース<br><?php echo $seminar_num . "/20"; ?></p><p id="child"><?php echo $seminar; ?></p></div>
  </div>
  <section>
    <a href="./csv" class="btn_02">【毎日17時更新】利用者名簿</a>
  </section>
  <section>
    <a href="../index.php" class="btn_02">戻る</a>
  </section>
  <footer>(c)Roma Tsutsumi</footer>
</div>
</body>
</html>
<?php $mysqli->close(); ?>