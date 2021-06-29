<?php 
	require_once "register/config.php";
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>mmlp</title>
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles1.css">
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
				<img src="images/movies/raya.jpg" alt="Deadpool Movie Poster" class="featured_image">
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp
				
				<a href="booking/booking.php">	<button class="btn btn-slide-left">Book Now!</button></a>
			</div>
			<div id="content">
               <h2 class="feature">Featured: </h2>
				<h2 class="title" >Raya and The Last Dragon</h2>
				<div class="ratings">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star inactive"></i>
				</div>

				<p class="description">Raya, a warrior, sets out to track down Sisu, a dragon,
                 who transferred all her powers into a magical gem which is now scattered all 
                 over the kingdom of Kumandra, dividing its people.</p>

				<p class="info">PG <span>|</span> 2 hours <span>|</span> Action | Anime | Adventure <span>|</span> June 19, 2021</p>
				 
                
             
				
            

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
			<button type="submit" formaction="overview/malcolm.php"class="scanfcode">
				<img src="images/movies/malcolm.jpg" alt="The Martian">
				
				<h3 class="title">Malcolm & Marie</h3>
				<p class="post_info">R | Drama , Romance <br> 1 hour, 54 minutes<br> </p>
</button>
			</div>

</div>
			<div class="row">
			<div class="post">
			<button type="submit" formaction="overview/raya.php"class="scanfcode">
				<img src="images/movies/raya.jpg" alt="Inside Out">
				<h3 class="title">Raya and The Last Dragon</h3>
				<p class="post_info">PG | Anime , Adventure <br> 2 hours <br></p>
			
			</div>
			</button>
		</div>

		<div class="row">
			<div class="post">
			<button type="submit" formaction="overview/mitchell.php"class="scanfcode">
				<img src="images/movies/mitchell.jpg" alt="Werewolves Within">
				<h3 class="title">The Mitchells vs. the Machines</h3>
				<p class="post_info">U | Anime , Comedy <br> 2 hours<br></p>
</button>
			</div>
		</div>
		<div class="row">
	
		
	<div class="post">
	<button type="submit" formaction="overview/outside.php"class="scanfcode">
		<img src="images/movies/out_wire.jpg" alt="Mad Max">
		<h3 class="title" style="">Outside the Wire</h3>
		<p class="post_info">R | Action , Fantasy <br>   1 hour, 54 minutes<br></p>
</button>
	</div>
	</div>
			
			<div class="row">
			<div class="post">
			<button type="submit" formaction="overview/little.php"class="scanfcode">
				<img src="images/movies/little.jpg" alt="Star Wars">
				<h3 class="title">The Little Things</h3>
				<p class="post_info">15 | Crime , Drama <br>  2 hours, 12 minutes<br></p>

			</div>
			</button>
		</div>
		<div class="row">
			<div class="post">
			<button type="submit" formaction="overview/mk11.php"class="scanfcode">
				<img src="images/movies/MK11.jpg" alt="The Avengers">
				<h3 class="title">Mortal Kombat 11</h3>
				<p class="post_info">15 | Action , Fantasy <br>  1 hour, 49 minutes<br></p>
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