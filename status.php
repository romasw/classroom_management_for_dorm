<?php 
require('header.php');
require('mysql.php');
$query = "select count(student) as cnt from students WHERE classroom=1;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$dai = $row["cnt"];
$query = "select count(student) as cnt from students WHERE classroom=2;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$shityou = $row["cnt"];
$query = "select count(student) as cnt from students WHERE classroom=3;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$multi = $row["cnt"];
$query = "select count(student) as cnt from students WHERE classroom=4;";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$seminar = $row["cnt"];

//利用時間取得
// $today = date('Y-m-d');
$today = date('2021-09-27');
$query = "select start_time, end_time from available_time where classroom=1 AND the_date='" . $today . "';";
if($result = $mysqli->query($query)){
  $row = $result->fetch_assoc();
  if(empty($row["start_time"])){
    $dai_time = "本日は利用不可です";
  }else{
    $dai_start = date('H:i', strtotime($row["start_time"]));
    $dai_end = date('H:i', strtotime($row["end_time"]));
    $dai_time = $dai_start . "～" . $dai_end;
  }
}else{
  $dai_time = "本日は利用不可です";
}


$query = "select start_time, end_time from available_time where classroom=2 AND the_date='" . $today . "';";
if($result = $mysqli->query($query)){
  $row = $result->fetch_assoc();
  if(empty($row["start_time"])){
    $shityou_time = "本日は利用不可です";
  }else{
    $shityou_start = date('H:i', strtotime($row["start_time"]));
    $shityou_end = date('H:i', strtotime($row["end_time"]));
    $shityou_time = $shityou_start . "～" . $shityou_end;
  }
}else{
  $shityou_time = "本日は利用不可です";
}

$query = "select start_time, end_time from available_time where classroom=3 AND the_date='" . $today . "';";
if($result = $mysqli->query($query)){
  $row = $result->fetch_assoc();
  if(empty($row["start_time"])){
    $multi_time = "本日は利用不可です";
  }else{
    $multi_start = date('H:i', strtotime($row["start_time"]));
    $multi_end = date('H:i', strtotime($row["end_time"]));
    $multi_time = $multi_start . "～" . $multi_end;
  }
}else{
  $multi_time = "本日は利用不可です";
}

$query = "select start_time, end_time from available_time where classroom=4 AND the_date='" . $today . "';";
if($result = $mysqli->query($query)){
  $row = $result->fetch_assoc();
  if(empty($row["start_time"])){
    $seminar_time = "本日は利用不可です";
  }else{
    $seminar_start = date('H:i', strtotime($row["start_time"]));
    $seminar_end = date('H:i', strtotime($row["end_time"]));
    $seminar_time = $seminar_start . "～" . $seminar_end;
  }
}else{
  $seminar_time = "本日は利用不可です";
}

?>
<body>
  <div class="footerFixed">
    <h1>寮生用教室入退室管理システム</h1>
    <h2>現在の状況</h2>
    <div class="status-container">
      <!-- <div class="status-item"><p id="room">大教室</p><p id="child"><?php echo $dai; ?>/40</p></div>
      <div class="status-item"><p id="room">視聴覚室</p><p id="child"><?php echo $shityou; ?>/20</p></div>
      <div class="status-item"><p id="room">MM教室</p><p id="child"><?php echo $multi; ?>/20</p></div> -->
      <div class="status-item"><p id="room">セミナー・<br>交流スペース</p><p id="child"><?php echo $seminar; ?>/20</p></div>
    </div>
    <h2>本日利用可能な時間帯</h2>
    <div class="information">
      <ul>
        <!-- <li>大教室：<?php echo $dai_time ?></li>
        <li>視聴覚室：<?php echo $shityou_time ?></li>
        <li>マルチメディア教室：<?php echo $multi_time ?></li> -->
        <li>セミナー・交流スペース：<?php echo $seminar_time ?></li>
      </ul>
    </div>
    <section>
      <a href="index.php" class="btn_02">戻る</a>
    </section>
    <footer>(c)Roma Tsutsumi</footer>
  </div>
</body>
</html>
<?php $mysqli->close(); ?>