<?php 
require('./header.php');
require('./mysql.php');
if(isset($_POST['classroom'])){
  if($_POST['classroom']==0){
    print "<script>alert('教室を選択してください');</script>";
  }else if($_POST['building']==0){
    print "<script>alert('棟を選択してください');</script>";
  }else if($_POST['room_num'] < 101 || $_POST['room_num'] > 521){
    print "<script>alert('部屋番号が正しくありません');</script>";
  }else{
    $capacity = array(
      1 => 40,
      2 => 20,
      3 => 20,
      4 => 20,
    );
    $classroom = $_POST['classroom'];
    $building = $_POST['building'];
    $room_num = $_POST['room_num'];
    $student = $building*1000 + $room_num;
    $query = "select count(student) as cnt from students where student=" . $student . ";";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $count = $row["cnt"];
    $query = "select count(student) as cnt from students WHERE classroom=". $classroom .";";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $num = $row["cnt"];
    if($num>=$capacity[$classroom]){
      print "<script>alert('その教室は定員に達しています。');</script>";
    }else{
      if($count=="1") {
        $query = "select STUDENT, CLASSROOM from students where student=" . $student . ";";
        $result = $mysqli->query($query);
        while($rows = $result->fetch_assoc()){
          if($rows['CLASSROOM']==0){
            $query="UPDATE students SET classroom=" . $classroom . " where student=" . $student . ";";
            $res = $mysqli->query($query);
            if($res){
              $date = date('H:i:s');
              $table = array(
                1 => "dai",
                2 => "shityou",
                3 => "multi",
                4 => "seminar",
              );
              $query = "INSERT INTO ". $table[$classroom] ." (STUDENT, ENTER_TIME) VALUES ( " . $student . ", '" . $date . "');";
              if($result = $mysqli->query($query)){
                header('Location: ./success.php?in_out=0&classroom='.$classroom);
              }else{
                print_r($result);
                print "<script>alert('データの登録に失敗しました');</script>";
              }
            }else{
              print_r($res);
              print "<script>alert('データの登録に失敗しました');</script>";
            }
          }else{
            switch($building){
              case 1:
                $build = "新友館";
                break;
              case 2:
                $build = "西友館";
                break;
              case 3:
                $build = "北友館";
                break;
              case 4:
                $build = "紫峰館";
                break;
            }
            if($rows['CLASSROOM']==1){
              $room = "大教室";
            }else if($rows['CLASSROOM']==2){
              $room = "視聴覚室";
            }else if($rows['CLASSROOM']==3){
              $room = "マルチメディア教室";
            }else if($rows['CLASSROOM']==4){
              $room = "セミナー・交流スペース";
            }
            print "<script>alert('" . $build . $room_num . "号室は既に" . $room . "に入室しています');</script>";
          }
        }
        $result->close();
      }else{
        $query = "INSERT INTO students VALUES ( " . $student . ", " . $classroom . ");";
        if($result = $mysqli->query($query)){
          $date = date('H:i:s');
          $table = array(
            1 => "dai",
            2 => "shityou",
            3 => "multi",
            4 => "seminar"
          );
          $query = "INSERT INTO ". $table[$classroom] ." (STUDENT, ENTER_TIME) VALUES ( " . $student . ", '" . $date . "');";
          if($result = $mysqli->query($query)){
            header('Location: ./success.php?in_out=0&classroom='.$classroom);
          }else{
            print_r($result);
            print "<script>alert('データの登録に失敗しました');</script>";
          }
        }else{
          print_r($result);
          print "<script>alert('データの登録に失敗しました');</script>";
        }
      }
    }
  }
}
?>
<body>
  <div class="footerFixed">
    <h1>寮生用教室入退室管理システム</h1>
    <form action="" method="post" name="form_in">
      <div class="cp_ipselect cp_sl02">
        <select name="classroom" required>
          <option value="0" hidden>教室を選んでください</option>
          <option value="1">大教室</option>
          <option value="2">視聴覚室</option>
          <option value="3">マルチメディア教室</option>
          <option value="4">セミナー・交流スペース</option>
        </select>
      </div>
      <div class="cp_ipselect cp_sl02">
        <select name="building" required>
          <option value="0" hidden>棟を選んでください</option>
          <option value="1">新友館</option>
          <option value="2">西友館</option>
          <option value="3">北友館</option>
          <option value="4">紫峰館</option>
        </select>
      </div>
      <div class="cp_iptxt">
        <input name="room_num" type="number" min=101 max=521 placeholder="部屋番号" style="width: 100px; border: none; outline:none;" required>
        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
      </div>
      <div class="btnbox">
        <a href="javascript:form_in.submit()" class="btn-in">
        <i class="fa fa-caret-right"></i> 入室
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