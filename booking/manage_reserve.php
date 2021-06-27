<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<!-- <script type="text/javascript" src="ajax.js"></script> -->

<?php

include 'admin/db_connect.php';
session_start();

$ts = $conn->query("SELECT * FROM theater_settings where theater_id=".$_GET['id']);
$data = array();

while($row=$ts->fetch_assoc())
{
	$data[] = $row;
	$seat_group[$row['id']] = $row['seat_group'];
	$seat_count[$row['id']] = $row['seat_count'];
}

 $mov = $conn->query("SELECT * FROM movies where id =".$_GET['mid'])->fetch_array();

 $dur = explode('.', $mov['duration']);
 $dur[1] = isset($dur[1]) ? $dur[1] : 0;
 $hr = sprintf("%'.02d\n",$dur[0]);
 $min = isset($dur[1]) ? (60 * ('.'.$dur[1])) : '0';
 $min = sprintf("%'.02d\n",$min);

 $duration = $hr.' : '.$min;

	$_SESSION['movie'] = $_GET['mid'];
?>


<div class="row">
	<div class="form-group col-md-4">
	<label for="" class="control-label">Choose Seat Group</label>
		<select name="seat_group" id="seat_group" class="custom-select default-browser" required>
			<option value="">
				
			</option>
			<?php 
				foreach($seat_group as $k => $v):

			?>
			<option value="<?php echo $k ?>" data-count="<?php echo $seat_count[$k] ?>"><?php echo $v ?></option>
		<?php endforeach; ?>
		</select>
	</div>
</div>


<div class="row">
	<div class="form-group col-md-4">
		<label class="control-label">Date</label>
		<select name="showdate" id="showdate" class="custom-select browser-default" required>
			<option value="">Select Date</option>
		

		</select>
	</div>

	<div class="form-group col-md-4">
		<label class="control-label">Time</label>
		<select name="time" id="time" class="custom-select browser-default" required>
			<option value="">Select Time</option>
			
		</select>
	</div>
	

	<!-- <div id="display-count" class="col-md-5 mt-4 pt-2"></div> -->

	<div class="form-group col-md-2">
		<label for="" class="control-label">Quantity</label>
		<input type="number" name="qty" id="qty" class="form-control" min="0" max="5" required="">
	</div>


	
</div>


<script type="text/javascript">
	var movie_id;

	$(document).ready(function() {
	  $("#seat_group").change(function() {
	    var seat_groups = $(this).val();
	    var movie_id;
	    if(seat_groups != "") {
	      $.ajax({
	        url:"get-date.php",
	        data:{theaters_id: seat_groups, movie_id},
	        type:'POST',
	        success:function(response) {
	          var resp = $.trim(response);
	          $("#showdate").html(resp);
	          $('#time').html('<option value="">Select date first</option>'); 
	        }
	      });
	    } else {
	      $('#showdate').html('<option value="">Select seat group first</option>');
           $('#time').html('<option value="">Select date first</option>'); 
	    }
	  });
	});
    
   $(document).ready(function() {
  $("#showdate").change(function() {
    var date_id = $(this).val();
    if(date_id != "") {
      $.ajax({
        url:"get-date.php",
        data:{d_id: date_id},
        type:'POST',
        success:function(response) {
          var resp = $.trim(response);
          $("#time").html(resp);
        }
      });
    } else {
      $("#time").html("<option value=''>Select date first</option>");
    }
  });
});

</script>

<script>
	
	// $('#seat_group').change(function(){
	// 	$('#display-count').html($(this).find('option[value="'+$(this).val()+'"]').attr('data-count')+' seats available')
	// 	$('#qty').removeAttr('max').attr('max',$(this).find('option[value="'+$(this).val()+'"]').attr('data-count'))
	// })

</script>
