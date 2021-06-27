<?php
 include("admin/db_connect.php"); 

    if(!empty($_POST['theaters_id'])) {

      session_start();
      $movie = $_SESSION['movie'];
      $_SESSION['theater_id'] = $_POST['theaters_id'];
      $theater_id = $_POST['theaters_id'];
      $request = "SELECT DISTINCT * FROM movies_showtime WHERE ts_id = $theater_id AND movie_id = $movie";
      
      $res = mysqli_query($conn, $request);
        
        echo '<option value=""> Select Date</option>'; 
        if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_object($res)) 
          {
            echo "<option value='".$row->showdate."'>".$row->showdate."</option>";    
          }
    } else {
         echo '<option value="">No date available</option>'; 
    }

  }elseif(!empty($_POST['d_id'])) {

      session_start();
      $show_date = $_POST['d_id'];
      $ts_id = $_SESSION['theater_id'];
      $sql = "SELECT showtime FROM movies_showtime WHERE showdate = '$show_date' AND ts_id = $ts_id";
      $res = mysqli_query($conn, $sql);

      echo '<option value="">Select Time</option>'; 
      if(mysqli_num_rows($res) > 0) {
        while($row = mysqli_fetch_object($res)) {
          echo "<option value='".$row->showtime."'>".$row->showtime."</option>";
        }
    } else {
       echo '<option value="">Time not available</option>'; 
    }     
 }


    
?>