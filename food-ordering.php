<?php
// Initialize the session
session_start();

require_once "register/config.php";

$id = $_SESSION["id"];

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: register/login.php");
    exit;
}
    

if(isset($_POST['ticket_submit']))
{

		$sql = "SELECT * FROM food_menu";   
		$result = mysqli_query($link, $sql);
		$food = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

	if(!empty($_POST['fries_id'])) 
        {
          	$fries = $_POST['fries_id'];
        } else {
        	$fries = 0;
		}

	if(!empty($_POST['popcorn_id'])) 
        {
          	$popcorn = $_POST['popcorn_id'];
        } else {
        	$popcorn = 0;
		}

	if(!empty($_POST['nachos_id'])) 
        {
          	$nachos = $_POST['nachos_id'];
        } else {
          	$nachos = 0;
		}

	if(!empty($_POST['softdrinks_id'])) 
        {
          	$softdrinks = $_POST['softdrinks_id'];
        } else {
        	$softdrinks = 0;
		}

	if(!empty($_POST['water_id'])) 
        {
          	$water = $_POST['water_id'];
        } else {
        	$water = 0;
		}

  	$ticket_id = $_POST['ticket_id'];

  	$fries_price = $fries * $food['fries_menu_price'];
  	$popcorn_price = $popcorn * $food['popcorn_menu_price'];
  	$nachos_price = $nachos * $food['nachos_menu_price'];
  	$softdrinks_price = $softdrinks * $food['softdrinks_menu_price'];
  	$water_price = $water * $food['water_menu_price'];


  	$avail_times = $_POST['avail_times'];

  	if($_SESSION['total_points'] > ($avail_times*10))
  	{
  		$popcorn = $popcorn + $avail_times;
  	} else {
  		$avail_times = 0;
  	}
  	

	$result = mysqli_query($link, "SELECT * FROM food WHERE ticket_id = $ticket_id ");

	$num_rows = mysqli_num_rows($result);

	if ($num_rows > 0) {
		$sql = "UPDATE food SET num_fries = '$fries', fries_price = '$fries_price', popcorn_price = '$popcorn_price', num_popcorn = '$popcorn', nachos_price = '$nachos_price', num_nachos = '$nachos', softdrinks_price = '$softdrinks_price', num_softdrinks = '$softdrinks', water_price = '$water_price', num_water = '$water' WHERE ticket_id = '$ticket_id'";

		if(mysqli_query($link, $sql)){

					$id = $_SESSION['id'];
					$_SESSION['total_points'] = $_SESSION['total_points'] -  $avail_times * 10;
                    $total_points = $_SESSION['total_points'];
					$sql = "UPDATE customers SET points = $total_points WHERE id = $id";

                    if(mysqli_query($link, $sql))
                    {
                        
                        header('Location: user_settings.php');
                    } else {
                    	echo 'query error: '. mysqli_error($link);
                    }

			} else {
				echo 'query error: '. mysqli_error($link);
			}

	} else {

		$sql = "INSERT INTO food(fries_price, num_fries, popcorn_price, num_popcorn, nachos_price, num_nachos, softdrinks_price, num_softdrinks, water_price, num_water, ticket_id) VALUES('$fries_price', '$fries', '$popcorn_price', '$popcorn', '$nachos_price', '$nachos', '$softdrinks_price', '$softdrinks', '$water_price', '$water', '$ticket_id')";

			if(mysqli_query($link, $sql)){
				// success
					$id = $_SESSION['id'];
					$_SESSION['total_points'] = $_SESSION['total_points'] -  $avail_times * 10;
                    $total_points = $_SESSION['total_points'];
					$sql = "UPDATE customers SET points = $total_points WHERE id = $id";


                    if(mysqli_query($link, $sql))
                    {
                        header('Location: user_settings.php');
                    } else {
                    	echo 'query error: '. mysqli_error($link);
					}

			} else {
				echo 'query error: '. mysqli_error($link);
			}
	}

}

  	



?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Food!</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles_food.css">
</head>
    
<body>
	<header id="top_header" class="clearfix">
		<div class="wrapper">
			<h1 class="logo"> <img src="images/MMLP.png" class="logo" style="width:25px;height:25px;margin-right: 5px"> <a href="index.php">MMLP</a>   </h1>
			<nav id="main_nav">
                <a href="booking/booking.php">Book Now!</a>
                <a href="user_settings.php">User</a>
				<a href="movies.php">Movies</a>
				<a href="faq.php">FAQ</a>
			</nav>
		</div>
	</header>

	

		
	<section id="top_movies" class="clearfix">
		<div class="wrapper">
			<header class="clearfix">
				<h2> Featured Food Menu: </h2>
			</header>

			<div class="row_1">
				<div class="post">
					<img src="images/food/french_fries.jpg" alt="french_fries">
					<h3 class="title">French Fries (₱ 50) </h3>
					<p class="post_info">Salted and seasoned delicious fries. Good for 1.</p>
					<p class="post_info"><b>Quantity:</b></p>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 

			  	<select name="fries_id">
			    <?php
					$fries_num = 0;
			        while($fries_num < 11)
			        {
			            echo "<option value='". $fries_num ."'>" .$fries_num ."</option>";  // displaying data in option menu
			            $fries_num++;
			        }

			        mysqli_free_result($result);
			    ?>
   	
			 	 </select>
			  			

				</div>
			</div>


			<div class="row_1">
				<div class="post">
					<img src="images/food/popcorn.jpg" alt="popcorn">
					<h3 class="title">Popcorn (₱ 40)</h3>
					<p class="post_info">Kernels popped to perfection. Good for 1.</p>
					<p class="post_info"><b>Quantity:</b></p>

				<select name="popcorn_id">
			   
			    <?php
					$popcorn_num = 0;
			        while($popcorn_num < 11)
			        {
			            echo "<option value='". $popcorn_num ."'>" .$popcorn_num ."</option>";  // displaying data in option menu
			            $popcorn_num++;
			        }

			        mysqli_free_result($result);
			    ?>
   	
			 	 </select>

				</div>
			</div>

			
		</div>
	</section>
    
    <section id="top_movies" class="clearfix">
        <div class="wrapper">
            
            <div class="row_2">
				<div class="post">
					<img src="images/food/nachos.jpg" alt="Nachos">
					<h3 class="title">Nachos (₱ 80)</h3>
					<p class="post_info">Crunchy corn with cream and custard.</p>
					<p class="post_info"><b>Quantity:</b></p>
                    	
                    <select name="nachos_id">
			  
			    		<?php
							$nachos_num = 0;
					        while($nachos_num < 11)
					        {
					            echo "<option value='". $nachos_num ."'>" .$nachos_num ."</option>";  // displaying data in option menu
					            $nachos_num++;
					        }

					        mysqli_free_result($result);
					    ?>
   	
			 	 	</select>

				</div>
			</div>

			<div class="row_2">
				<div class="post">
					<img src="images/food/soft_drinks.jpg" alt="The Avengers">
					<h3 class="title">Soft Drinks (₱ 30)</h3>
					<p class="post_info">175 ml</p>
					<p class="post_info"><b>Quantity:</b></p>
	          <select name="softdrinks_id">
				 
						    <?php
								$softdrinks_num = 0;
						        while($softdrinks_num < 11)
						        {
						            echo "<option value='". $softdrinks_num ."'>" .$softdrinks_num ."</option>";  // displaying data in option menu
						            $softdrinks_num++;
						        }

						        mysqli_free_result($result);
						    ?>
	   	
				 	 	</select>
				</div>
			</div>
            
            <div class="row_2">
				<div class="post">
					<img src="images/food/water.jpg" alt="water">
					<h3 class="title">Water (₱ 20)</h3>
					<p class="post_info">175 ml</p>
					<p class="post_info"><b>Quantity:</b></p>

                <select name="water_id">
				  
						    <?php
								$water_num = 0;
						        while($water_num < 11)
						        {
						            echo "<option value='". $water_num ."'>" .$water_num ."</option>";  // displaying data in option menu
						            $water_num++;
						        }

						        mysqli_free_result($result);
						    ?>
	   	
				 	 	</select>
				</div>
            </div>
        </div>
	</section> 
    
    	<div style="margin-left: 3.5em;">
        <h2>CHOOSE TICKET ID:</h2>

			  Choose ticket ID to include the food order:

			  <select name="ticket_id" required>
			    <?php

					$tickets = mysqli_query($link, "SELECT ticket_id FROM tickets WHERE total_price IS NULL");
							
			        while($data = mysqli_fetch_array($tickets))
			        {
			            echo "<option value='". $data['ticket_id'] ."'>" .$data['ticket_id'] ."</option>";  
			        }

			        mysqli_free_result($result);
			    ?>
   
			  </select>

			  <br><br> Limited Time! Use 10 points to add 1 popcorn. Choose how many times to avail: (Points can't be refunded once used.) 

			  	<select name="avail_times" required>
				  
						    <?php
								$avail_times = 0;
						        while($avail_times < 11)
						        {
						            echo "<option value='". $avail_times ."'>" .$avail_times ."</option>";  // displaying data in option menu
						            $avail_times++;
						        }
						    ?>
	   	
				</select>
				<br><br>
			   <button type="submit" type="input" name="ticket_submit" class="btn btn-outline-secondary mt-1">Update Ticket with Food Order</button>

</form>
		</div>
		<?php mysqli_close($link); ?>
        

	<footer id="main_footer">
		<p class="logo">MMLP</p>
		<p class="copyright">&copy;2021 Movies &amp; Stuff. All Rights Reserved.</p>
		<div class="links">
            <a href="#">About Us</a>
			<a href="#">Terms of Service</a>
			<a href="#">Privacy Policy</a>
		</div>
	</footer>
</body>
</html>