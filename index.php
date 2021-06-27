<?php 
	require_once "register/config.php";
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>mmlp</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	
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

    <section id="newsletter">
    <div class="newsletter_inner">
        <h2>MOVIE MARATHON LANG, PROMISE!</h2>
        <p>"Make the right thing to do the easy thing to do."</p>
        <div class="sign_up_form">
        	<p>Already have an account? Log in here.</p>
             <a href="register/register.php"> <button class="button">Sign up</button> </a>
             <a href="register/login.php">
            <button class="button">Log in</button></a>
        </div>
    </div>
    </section>

	<section id="banner" class="clearfix">
		<div id="banner_content_wrapper">
			<div id="poster">
				<img src="images/movies/f9.jpg" alt="Deadpool Movie Poster" class="featured_image">
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp
				
				<button class="btn btn-slide-left">Book Now!</button>
			</div>
			<div id="content">
				<h2 class="feature">Feature:</h2>
				<h2 class="title">F9</h2>
				<div class="ratings">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>

				<p class="description">Vin Diesel’s Dom Toretto is leading a quiet life off the 
		grid with Letty and his son, little Brian, but they 
		know that danger always lurks just over their peaceful 
		horizon. This time, that threat will force Dom to 
		confront the sins of his past if he’s going to save 
		those he loves most. His crew joins together to stop 
		a world-shattering plot led by the most skilled assassin 
		and high-performance driver they’ve ever encountered: 
		a man who also happens to be Dom’s forsaken brother, Jakob (John Cena).</p>

				<p class="info">PG-13 <span>|</span> 2 hours, 25 minutes <span>|</span> Action | Adventure | Sequel <span>|</span> June 25, 2021</p>

			</div>
		</div>
	</section>

	<section id="top_movies" class="clearfix">
		<div class="wrapper">
			<header class="clearfix">
				<h2>Popular Movies</h2>
				<a href="movies.php" class="view_more">View All Movies</a>
			</header>

			   
            <div class="row">
			
				<div class="post">
					<form>
				<button type="submit" formaction="overview/f9.php"class="scanfcode">
					<img src="images/movies/f9.jpg" alt="The Martian">
					
					<h3 class="title">Fast and Furious 9</h3>
					<p class="post_info">PG13 | Action , Genre <br> 2 hours, 25 minutes <br>  </p>
</button>
				</div>

</div>
			<div class="row">
				<div class="post">
				<button type="submit" formaction="overview/false_posititve.php"class="scanfcode">
					<img src="images/movies/fp.jpg" alt="Inside Out">
					<h3 class="title">False Positive</h3>
					<p class="post_info">R | Horror , Thriller <br>  1 hour, 32 minutes <br></p>
					</button>
				</div>
			</div>

			<div class="row">
				<div class="post">
				<button type="submit" formaction="overview/werewolves_within.php"class="scanfcode">
					<img src="images/movies/ww.jpg" alt="Werewolves Within">
					<h3 class="title">Werewolves Within</h3>
					<p class="post_info">R | Comedy , Horror <br>  1 hour, 40 minutes<br></p>
</button>
				</div>
			</div>
			<div class="row">
		
			
				<div class="post">
				<button type="submit" formaction="overview/felix_treasure.php"class="scanfcode">
					<img src="images/movies/fathd.jpg" alt="Mad Max">
					<h3 class="title" style="font-size:15px;">Felix And The Hidden Treasure</h3>
					<p class="post_info">PG | Family , Animation  <br>  1 hour, 30 minutes<br></p>
</button>
				</div>
			

		
			</div>
			
			<div class="row">
				<div class="post">
				<button type="submit" formaction="overview/against_the_current.php"class="scanfcode">
					<img src="images/movies/atc.jpg" alt="Star Wars">
					<h3 class="title">Against The Current</h3>
					<p class="post_info">NR | Documentary<br>  1 hour, 30 minutes<br></p>
</button>
				</div>
			</div>

			<div class="row">
				<div class="post">
				<button type="submit" formaction="overview/i_carry.php"class="scanfcode">
					<img src="images/movies/icywm.jpg" alt="The Avengers">
					<h3 class="title">I Carry You With Me</h3>
					<p class="post_info">R | Drama  <br>  1 hour, 50 minutes<br></p>
			</button>
				</div>
			</div>
            
		</div>
        
	</section>



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