 
 <?php

 session_start();

 $id = $_SESSION["id"];


 include 'admin/db_connect.php';

 $mov = $conn->query("SELECT * FROM movies where id =".$_GET['id'])->fetch_array();

 $duration = explode('.', $mov['duration']);

 $hr = sprintf("%'.02d\n",$duration[0]);
 $min = isset($duration[1]) ? (60 * ('.'.$duration[1])) : '0';
 $min = sprintf("%'.02d\n",$min);
 
 $duration = $hr.' : '.$min

 ?>


 <header class="masthead">
 	<div class="container pt-5">
 		<div class="col-lg-12">
 			<div class="row">
 				<div class="col-md-4">
 					<img src="img/<?php echo $mov['cover_img'] ?>" alt="" class="reserve-img">
 				</div>
 				<div class="col-md-8">
 					<div class="card bg-dark ">
 						<div class="card-body text-white">
 							<h3><b><?php echo $mov['title'] ?></b></h3>
 							<hr>
 							<p class=""><small><b>Description: </b><?php echo $mov['description'] ?></small></p>
 							<p class=""><small><b>Duration: </b><?php echo $duration ?> hrs</small></p>
 							<p class=""><b>Price: </b> $ <i><?php echo $mov['price'] ?></i></p>

 						</div>
 					</div>
 					<div class="card bg-light mt-2">
 						<div class="card-body">
 							<h4>Reserve your seat here:</h4>
 							<form action="" id="save-reserve">

 								<input type="hidden" name="movie_id" value="<?php echo $_GET['id'] ?>">
 								<input type="hidden" name="id" value="<?php echo $id ?>">
 								<input type="hidden" name="price" value="<?php echo $mov['price'] ?>">


 								<div class="row">
 								<div class="form-group col-md-4">
 									<label for="" class="control-label">Theater</label>
 									<select class="browser-default custom-select" name="ts_id">
 										<option value=""></option>
 										<?php 
											$qry = $conn->query("SELECT * FROM  theater order by name asc");
											while($row= $qry->fetch_assoc()):
 										?>	
 										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
 										<?php endwhile; ?>
 									</select>
 								</div>
 								</div>
 								<div id="display-other">
 									
 								</div>
 								<div class="row">
 									<button class="col-md-2 btn btn-block btn-primary">Book</button>
 								</div>
 							</form>

 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
</header>

<script>
	$('[name="ts_id"]').change(function(){
		$.ajax({
			url:'manage_reserve.php?id='+$(this).val()+'&mid=<?php echo $_GET['id'] ?>',
			success:function(resp){
				$('#display-other').html(resp)
			}
		})
	})
	$(document).ready(function(){
		$('#save-reserve').submit(function(){
			$('#save-reserve button').attr('disabled',true).html("Saving...")
			$.ajax({
				url:'admin/ajax.php?action=save_reserve',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
						alert("Reservartion successfully saved");
						location.replace('booking.php')
					} else {
						alert("Reservartion successfully saved");
						location.replace('booking.php')
					}
					
				}
			})
		})
	})
</script>
