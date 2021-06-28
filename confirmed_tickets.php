<?php 
	require_once "register/config.php";
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: register/login.php");
    exit;
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



		$sql = "SELECT theater_id, seat_group FROM theater_settings WHERE id = {$ticket['ts_id']} ";      
		// get the query result
		$result = mysqli_query($link, $sql);
		// fetch result in array format
		$theater_settings = mysqli_fetch_assoc($result);


		$sql = "SELECT name FROM theater WHERE id = {$theater_settings['theater_id']} ";      
		// get the query result
		$result = mysqli_query($link, $sql);
		// fetch result in array format
		$theater_id = mysqli_fetch_assoc($result);



		$sql = "SELECT theater_id FROM theater_settings WHERE id = {$ticket['ts_id']} ";      
		// get the query result
		$result = mysqli_query($link, $sql);
		// fetch result in array format
		$theater_seetings = mysqli_fetch_assoc($result);



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

		$_SESSION['total_price_food'] = $total_price_food;
		$_SESSION['movie_totalprice'] = $movie_totalprice;
		$_SESSION['ticket_id'] = $_GET['id'];

		$total_price = $total_price_food + $movie_totalprice;
		$_SESSION['total_price'] = $total_price;

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
                        <button type="button" class="btn">Go Back</button></a>  </h1>
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
			<h4> <b> Qty. of Tickets/Seats: </b> <?php echo htmlspecialchars($ticket['qty']); ?></h4>
			<h6> Theater No. : <?php echo htmlspecialchars($theater_settings['seat_group']); ?></h6>
			<h6> Seat Group : <?php echo htmlspecialchars($theater_id['name']); ?></h6>
			<h4>  Movie Name:  <?php echo htmlspecialchars($movie['title']); ?></h4>
			<h4>  Movie Price: ₱ <?php echo htmlspecialchars($movie['price']); ?></h4>
            <h4>  Booking Date:  <?php echo htmlspecialchars($ticket['date']); ?></h4>
			<h4> Booking Time: <?php echo htmlspecialchars($ticket['time']); ?></h4>
			<h4> Total Ticket Price:  ₱ <?php echo htmlspecialchars($ticket['price']); ?></h4>

			<?php if($num_rows == 0) {  ?> <h4> No food selected. </h4> <?php } ?>
			<?php if($num_rows != 0){ ?>
			<h4> Food Items: <i> Fries: </i> <b> <?php echo htmlspecialchars($food['num_fries']); ?> (₱<?php echo $food['fries_price']?>) </b> &nbsp <i> Popcorn: </i>  <b> <?php echo htmlspecialchars($food['num_popcorn']); ?> (₱<?php echo $food['popcorn_price']?>) </b> 
			 &nbsp <i> Nachos: </i> <b> <?php echo htmlspecialchars($food['num_nachos']); ?> (₱<?php echo $food['nachos_price']?>) <br><br> </b> &nbsp <i> Softdrinks: </i> <b> <?php echo htmlspecialchars($food['num_softdrinks']); ?> (₱<?php echo $food['softdrinks_price']?>) </b> &nbsp <i> Water: </i> <b> <?php echo htmlspecialchars($food['num_water']); ?> (₱<?php echo $food['water_price']?>) </b> <br><br> Total Food Price: ₱ <?php echo $total_price_food ?> <br><br> Overall Price: ₱ <?php echo $total_price ?>    </h4>

			<?php }  ?>

		</div> 
					
		<?php else: ?>
			<h5>Invalid ticket.</h5>
		<?php endif ?>
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