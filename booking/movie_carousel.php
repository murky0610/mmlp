<?php 
  include 'admin/db_connect.php';
  $movies = $conn->query("SELECT * FROM movies where '".date('Y-m-d')."' BETWEEN date(date_showing) and date(end_date)");
?>

  <center><h3 class="text-primary">Now Showing</h3></center>



<div id="movie-carousel-field">

  <div class="list-prev list-nav">
    <a href="javascript:void(0)" class="text"><i class="fa fa-angle-left"></i></a>
  </div>

  <div class="list">
    <?php while($row=$movies->fetch_assoc()): ?>
        <div class="movie-item">
          <img src="img/<?php echo htmlspecialchars($row['cover_img'])  ?>" alt="<?php echo htmlspecialchars($row['title']) ?>">

          <!-- goes to reserve.php -->
          <div class="mov-det">
            <button type="button" class="btn btn-primary" data-id="<?php echo $row['id'] ?>">Reserve Seat</button>
          </div>
        </div>
    <?php endwhile; ?>
  </div>

  <div class="list-next list-nav">
    <a href="javascript:void(0)" class="text"><i class="fa fa-angle-right"></i></a>
  </div>

</div>


<script>
  
  $('#movie-carousel-field .list-next').click(function(){
    $('#movie-carousel-field .list').animate({
    scrollLeft:$('#movie-carousel-field .list').scrollLeft() + ($('#movie-carousel-field .list').find('img').width() * 3)
   }, 'slow');
  })

  $('#movie-carousel-field .list-prev').click(function(){
    $('#movie-carousel-field .list').animate({
    scrollLeft:$('#movie-carousel-field .list').scrollLeft() - ($('#movie-carousel-field .list').find('img').width() * 3)
   }, 'slow');
  })
  
  // button to go to the reserve page
  $('.mov-det button').click(function(){
    location.replace('index.php?page=reserve&id='+$(this).attr('data-id'))
  })

</script>