<?php 
	require_once "register/config.php";
	session_start();

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($link, $_POST['id']);

		$sql = "DELETE FROM tickets WHERE ticket_id = $id_to_delete";

		if(mysqli_query($link, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($link);
		}

	}

	// check GET request id param
	if(isset($_GET['id'])){
		// escape sql chars
		$id = mysqli_real_escape_string($link, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM tickets WHERE ticket_id = $id";
		         
		// get the query result
		$result = mysqli_query($link, $sql);

		// fetch result in array format
		$ticket = mysqli_fetch_assoc($result);

		$movie_id = $ticket['movie_id'];

		$sql = "SELECT title, cover_img, price FROM movies WHERE id = $movie_id";

		// get the query result
		$result = mysqli_query($link, $sql);

		$movie  = mysqli_fetch_assoc($result);

		$sql = "SELECT * FROM food WHERE ticket_id = $id";

		$result = mysqli_query($link, $sql);
		$num_rows = mysqli_num_rows($result);

		$total_price_food = 0;
		$movie_totalprice = $ticket['price'];

		if($num_rows != 0)
		{
			$food  = mysqli_fetch_assoc($result);
			$total_price_food = $food['fries_price'] + $food['popcorn_price'] + $food['nachos_price'] + $food['softdrinks_price'] + $food['water_price'];
		}

		$total_price = 
		

		mysqli_free_result($result);
		mysqli_close($link);

	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>mmlp</title>
	<link rel="stylesheet" type="text/css" href="css/styles_payment.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">

	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
    
<body>
	<header id="top_header" class="clearfix">
		<div class="wrapper">
			<h1 class="logo"> <a href="user_settings.php">
                        <button type="button" class="btn btn-outline-info">Go Back</button></a> <a href="food-ordering.php">
             	<button type="button" class="waves-effect waves-light  btn">Update Food Choices</button> </a>   </h1>
		</div>
	</header>


<div class="row">
	<div class="container grey-text">
	    <div class="col s3 offset-s1">
	      <div class="card">
	        <div class="card-image">
	          <img src="booking/img/<?php echo $movie['cover_img']  ?>">
	        </div>
	      </div>
	    </div>

		<div class="center-align">
		<?php if($ticket): ?>

			<h4> <b> Ticket ID: </b> <?php echo htmlspecialchars($ticket['ticket_id']); ?></h4>
			<h4> <b> Qty. of Tickets: </b> <?php echo htmlspecialchars($ticket['qty']); ?></h4>
			<h4>  Movie Name:  <?php echo htmlspecialchars($movie['title']); ?></h4>
			<h4>  Movie Price: ₱ <?php echo htmlspecialchars($movie['price']); ?></h4>
            <h4>  Booking Date:  <?php echo htmlspecialchars($ticket['date']); ?></h4>
			<h4> Booking Time: <?php echo htmlspecialchars($ticket['time']); ?></h4>
			<h4> Total Ticket Price:  ₱ <?php echo htmlspecialchars($ticket['price']); ?></h4>

			<?php if($num_rows == 0) {  ?> <h4> No food selected. </h4> <?php } ?>
			<?php if($num_rows != 0){ ?>
			<h4> Food Items: <i> Fries: </i> <b> <?php echo htmlspecialchars($food['num_fries']); ?> (₱<?php echo $food['fries_price']?>) </b> &nbsp <i> Popcorn: </i>  <b> <?php echo htmlspecialchars($food['num_popcorn']); ?> (₱<?php echo $food['popcorn_price']?>) </b> 
			 &nbsp <i> Nachos: </i> <b> <?php echo htmlspecialchars($food['num_nachos']); ?> (₱<?php echo $food['nachos_price']?>) <br><br> </b> &nbsp <i> Softdrinks: </i> <b> <?php echo htmlspecialchars($food['num_softdrinks']); ?> (₱<?php echo $food['softdrinks_price']?>) </b> &nbsp <i> Water: </i> <b> <?php echo htmlspecialchars($food['num_water']); ?> (₱<?php echo $food['water_price']?>) </b> <br><br> Total Food Price: <?php echo $total_price_food ?>  </h4>

			<?php }  ?>
		</div>
					

		<?php else: ?>
			<h5>Invalid ticket.</h5>
		<?php endif ?>
	</div>
</div>

<div class="center-align">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		
		<input type="hidden" name="id" value="<?php echo $ticket['ticket_id']; ?>">
							
			
				<input type="submit" name="delete"  value="Delete" class="waves-effect waves-light red btn">

</form>
  				<input type="submit" name="confirm"  value="Confirm Booking" class="waves-effect waves-light green lighthen-2 btn">

  				
        		</div>
</div>

	<footer id="main_footer">
		<p class="logo">MMLP</p>
		<p class="copyright">&copy;2021 MMLP. All Rights Reserved.</p>
		<div class="links">
            <a href="#">About Us</a>
			<a href="#">Terms of Service</a>
			<a href="#">Privacy Policy</a>
		</div>
	</footer>
</body>
</html>