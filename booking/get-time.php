<?php include("admin/db_connect.php"); ?>

<?php

if(isset($_POST['d_id'])) {
  $show_date = $_POST['d_id'];
  $sql = "SELECT showtime FROM movies_showtime WHERE showdate = '$show_date'";
  $res = mysqli_query($conn, $sql);

  if(mysqli_num_rows($res) > 0) {
    echo "<option value=''>------- Select --------</option>";
    while($row = mysqli_fetch_object($res)) {
      echo "<option value='".$row->showtime."'>".$row->showtime."</option>";
    }
  }
} else {
  header('location: ./');
}


?>

