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
				<img src="images/movies/deadpool.jpg" alt="Deadpool Movie Poster" class="featured_image">
				<img src="images/play_button.png" alt="Play Trailer" class="play_button">
			</div>
			<div id="content">
                <h2 class="feature">Featured: </h2>
				<h2 class="title">Deadpool</h2>
				<div class="ratings">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star inactive"></i>
				</div>

				<p class="description">A former Special Forces operative turned mercenary is subjected to a rogue experiment that leaves him with accelerated healing powers, adopting the alter ego Deadpool.</p>

				<p class="info">R <span>|</span> 108 min <span>|</span> Action, Adventure, Comedy <span>|</span> 12 February 2016</p>
                
                <a href="booking/booking.php"> <button class="button">Book Now!</button> </a>
                

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
					<img src="images/movies/the-martian.jpg" alt="The Martian">
					<h3 class="title">The Martian</h3>
					<p class="post_info">PG13 | 109 Minutes</p>
				</div>
			</div>

			<div class="row">
				<div class="post">
					<img src="images/movies/inside-out.jpg" alt="Inside Out">
					<h3 class="title">Inside Out</h3>
					<p class="post_info">PG13 | 109 Minutes</p>
				</div>
			</div>

			<div class="row">
				<div class="post">
					<img src="images/movies/jurassic-world.jpg" alt="Jurassic World">
					<h3 class="title">Jurassic World</h3>
					<p class="post_info">PG13 | 109 Minutes</p>
				</div>
			</div>

			<div class="row">
				<div class="post">
					<img src="images/movies/mad-max.jpg" alt="Mad Max">
					<h3 class="title">Mad Max</h3>
					<p class="post_info">PG13 | 109 Minutes</p>
				</div>
			</div>

			<div class="row">
				<div class="post">
					<img src="images/movies/star-wars.jpg" alt="Star Wars">
					<h3 class="title">Star Wars</h3>
					<p class="post_info">PG13 | 109 Minutes</p>
				</div>
			</div>

			<div class="row">
				<div class="post">
					<img src="images/movies/avengers.jpg" alt="The Avengers">
					<h3 class="title">Avengers</h3>
					<p class="post_info">PG13 | 109 Minutes</p>
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