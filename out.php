<?php 
require('./header.php'); 
require('./mysql.php');
if(isset($_POST['building'])){
  if($_POST['building']==0){
    print "<script>alert('棟を選択してください');</script>";
  }else if($_POST['room_num'] < 101 || $_POST['room_num'] > 521){
    print "<script>alert('部屋番号が正しくありません');</script>";
  }else{
    $building = $_POST['building'];
    $room_num = $_POST['room_num'];
    $student = $building*1000 + $room_num;
    $query = "select count(student) as cnt from students where student=" . $student . ";";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row["cnt"];
    if($count=="1") {
      $query = "select STUDENT, CLASSROOM from students where student = " . $student . ";";
      $result = $mysqli->query($query);
      $row = $result->fetch_assoc();
      $classroom=$row["CLASSROOM"];
      if($classroom==0){
        print $rows["CLASSROOM"];
        print "<script>alert('あなたはまだ入室していません');</script>";
      }else{
        $query="UPDATE students SET classroom=0 where student=" . $student . ";";
        $res = $mysqli->query($query);
        if($res){
          $date = date('H:i:s');
          $table = array(
            1 => "dai",
            2 => "shityou",
            3 => "multi",
            4 => "seminar"
          );
          $query = "UPDATE ". $table[$classroom] ." SET EXIT_TIME='" . $date . "' where student=". $student ." AND exit_time IS null;";
          if($result = $mysqli->query($query)){
            header('Location: ./success.php?in_out=1&classroom='.$classroom);
          }else{
            print_r($result);
            print "<script>alert('データの登録に失敗しました');</script>";
          }
        }else{
          print_r($res);
          print "<script>alert('データの登録に失敗しました');</script>";
        }
      }
    }else{
      print "<script>alert('あなたはまだ入室していません');</script>";
    }
  }
}

?>
<body>
  <div class="footerFixed">
    <h1>寮生用教室入退室管理システム</h1>
    <form action="" method="post" name="form_out">
      <div class="cp_ipselect cp_sl02">
        <select name="building" required>
          <option value="" hidden>棟を選んでください</option>
          <option value="1">新友館</option>
          <option value="2">西友館</option>
          <option value="3">北友館</option>
          <option value="4">紫峰館</option>
        </select>
      </div>
      <div class="cp_iptxt">
        <input type="number" name="room_num" min=101 max=521 placeholder="部屋番号" style="width: 100px; border: none; outline:none;">
        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
      </div>
      <div class="btnbox">
        <a href="javascript:form_out.submit()" class="btn-out">
          <i class="fa fa-caret-right"></i> 退室
        </a>
      </div>
    </form>
    <section>
      <a href="index.php" class="btn_02">戻る</a>
    </section>
    <footer>(c)Roma Tsutsumi</footer>
  </div>
</body>
</html>
<?php $mysqli->close(); ?>
