<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<?php

include 'admin/db_connect.php';

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

	<div id="display-count" class="col-md-5 mt-4 pt-2"></div>		

</div>

<div class="row">
	<div class="form-group col-md-2">
		<label for="" class="control-label">Quantity</label>
		<input type="number" name="qty" id="qty" class="form-control" min="0" required="">
	</div>


	<div class="form-group col-md-4">
		<label for="" class="control-label">Date</label>
		<select name="showdate" id="showdate" class="custom-select browser-default" required>
		<option value=''>------- Select --------</option>
		<?php

		$showtime_id = $mov['showtime_id'];
		$request = "SELECT DISTINCT showdate FROM movies_showtime WHERE showtime_id = $showtime_id";
		// $query = mysqli_query($conn, $request);

		$res = mysqli_query($conn, $request);
     	
     	if(mysqli_num_rows($res) > 0) {
        	while($row = mysqli_fetch_object($res)) {
          echo "<option value='".$row->showdate."'>".$row->showdate."</option>";

     	   }
      	}
		
		?>


		</select>
	</div>

	<div class="form-group col-md-4">
		<label class="control-label">Time</label>
		<select name="time" id="time" class="custom-select browser-default" required>
			<option> Select </option>
			
		</select>
	</div>
</div>


<script>
	
	$('#seat_group').change(function(){
		$('#display-count').html($(this).find('option[value="'+$(this).val()+'"]').attr('data-count')+' seats available')
		$('#qty').removeAttr('max').attr('max',$(this).find('option[value="'+$(this).val()+'"]').attr('data-count'))
	})



</script>