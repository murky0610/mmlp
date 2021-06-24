<?php 
	require_once "register/config.php";
	

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
                        <button type="button" class="btn btn-outline-info">Go Back</button></a>   </h1>
		</div>
	</header>



	<div class="container center grey-text">
		<?php if($ticket): ?>

			<h4> Ticket ID: <?php echo htmlspecialchars($ticket['ticket_id']); ?></h4>
            <h4> Booking Date: <?php echo htmlspecialchars($ticket['date']); ?></h4>
			<h4> Booking Time: <?php echo htmlspecialchars($ticket['time']); ?></h4>
			<h4> Total price: ₱ <?php echo htmlspecialchars($ticket['price']); ?></h4>


			<!-- DELETE FORM -->
			<form action="payment.php" method="POST">
				<input type="hidden" name="id" value="<?php echo $ticket['ticket_id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>Invalid ticket.</h5>
		<?php endif ?>
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