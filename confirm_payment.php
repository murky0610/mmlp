<?php

require_once "register/config.php";

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: register/login.php");
    exit;
}


$ticket_id = $_SESSION['ticket_id'];
$total_price_food = $_SESSION['total_price_food'];
$movie_totalprice = $_SESSION['movie_totalprice'];
$total_price = $_SESSION['total_price'];

$sql = "SELECT * FROM tickets WHERE ticket_id = $ticket_id";
$result = mysqli_query($link, $sql);
$ticket = mysqli_fetch_assoc($result);

echo print_r($ticket);

$id = $ticket['id']; 
$movie_id = $ticket['movie_id'];
$date = $ticket['date'];
$time = $ticket['time'];
$ts_id = $ticket['ts_id'];
$seat_qty = $ticket['qty'];

$seats = "SELECT available_seats FROM movies_showtime WHERE movie_id = $movie_id AND ts_id = $ts_id AND showdate = '$date' AND showtime = '$time' ";

$result = mysqli_query($link, $seats);
$ava_seats = mysqli_fetch_assoc($result);

echo print_r($ava_seats);

$seats_left = $ava_seats['available_seats'] - $seat_qty;

echo $seats_left;

if($seats_left < 0 ){
    $message = "Too late! No more seats left! Please delete ticket. ";
    echo "<script type='text/javascript'>alert('$message'); window.location.href='user_settings.php';</script>";
}

$_SESSION['cardname'] = "";
$_SESSION['paypal_email'] = "";
$_SESSION['paypal_password'] = "";
$_SESSION['ewallet_id'] = "";
$_SESSION['ewallet'] = "";


if(isset($_POST['credit_card_submit']))
{
        $_SESSION['cardname'] = "";
        $cardname = trim($_POST["username"]);

        if(empty($cardname)){
            $username_err = "Please enter a username.";

        } elseif(!preg_match('/^[a-zA-Z .]+$/',($cardname))){
            $username_err = "Username can only contain letters and spaces.";

        }elseif(empty($username_err)){

            $_SESSION['cardname'] = $cardname;
        }


        $_SESSION['creditcardnum'] = "";
        $creditcardnum = trim($_POST["cardNumber"]);

        function validatecard($creditcardnum)
         {
            global $type;

            $cardtype = array(
                "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
                "mastercard" => "/^5[1-5][0-9]{14}$/",
                "amex"       => "/^3[47][0-9]{13}$/",
                "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
            );

            if (preg_match($cardtype['visa'], $creditcardnum))
            {
            $type = "visa";
                return true;
            
            }
            else if (preg_match($cardtype['mastercard'], $creditcardnum))
            {
            $type = "mastercard";
                return true;
            }
            else if (preg_match($cardtype['amex'], $creditcardnum))
            {
            $type = "amex";
                return true;
            
            }
            else if (preg_match($cardtype['discover'], $creditcardnum))
            {
            $type = "discover";
                return true;
            }
            else
            {
                return false;
            } 
         }

        validatecard($creditcardnum);


         if(empty($creditcardnum)){
            $cardNumber_err = "Please enter a credit card.";
         }elseif(validatecard($creditcardnum) == false){
            $cardNumber_err = "Please enter a valid credit card.";
         } else {
            $_SESSION['creditcardnum'] = $creditcardnum;
         }


        $_SESSION['mm'] = "";
        $mm = trim($_POST["mm"]);

        if(empty($mm)){
            $mm_err = "Please enter a month.";

        } elseif( $mm > 0 && $mm <= 12 ){
            $_SESSION['mm'] = $mm;

        }else{
            $mm_err = "Please enter valid month.";
        }


        $_SESSION['yy'] = "";
        $yy = trim($_POST["yy"]);

        if(empty($yy)){
            $yy_err = "Please enter a year.";

        } elseif( $yy >= 21 && $yy <= 31 ){
            $_SESSION['yy'] = $yy;

        }else{
            $yy_err = "Please enter valid year.";
        }

        $_SESSION['cvv'] = "";
        $cvv = trim($_POST["cvv"]);

        if(empty($cvv)){
            $cvv_err = "Please enter CVV.";

        } elseif( $cvv >= 0 && $cvv <= 999 ){
            $_SESSION['cvv'] = $cvv;

        }else{
            $cvv_err = "Please enter valid CVV.";
        }

        if( (empty($username_err) && empty($cardNumber_err) && empty($mm_err) && empty($yy_err) && empty($cvv_err)) == 1)
        {
            $sql = "UPDATE movies_showtime SET available_seats = $seats_left WHERE movie_id = $movie_id AND ts_id = $ts_id AND showdate = '$date' AND showtime = '$time' ";

             if(mysqli_query($link, $sql)){
                    
                        $form_of_payment = "Credit_Card";

                        $update = "UPDATE tickets SET food_price = $total_price_food, total_price = $total_price, form_of_payment = '$form_of_payment' WHERE ticket_id = $ticket_id"; 

                        if(mysqli_query($link, $update)){

                                $points = $movie_totalprice / 150;
                                $_SESSION['total_points'] = $_SESSION['total_points'] + $points;
                                $total_points = $_SESSION['total_points'];

                                $sql = "UPDATE customers SET points = $total_points WHERE id = $id";

                                if(mysqli_query($link, $sql)){
                                        
                                        header('Location: user_settings.php');
                                    } else {

                                        echo 'query error: '. mysqli_error($link);
                                    }
                        } else {

                            echo 'query error: '. mysqli_error($link);
                        }
            } else {

                echo 'query error: '. mysqli_error($link);
            }

         }


}



if(isset($_POST['paypal_submit']))
{
    $_SESSION['paypal_email'] = "";
    $email = trim($_POST["email"]);

    if(empty($email))
    {
        $email_err = "An email is required.";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_err = "Email must be a valid email address.";
    }else{
        $_SESSION['paypal_email'] = $email;
    }

    $_SESSION['paypal_password'] = "";
    $password = $_POST["password"];

    if(empty($password))
    {
        $password_err = "An email is required.";
    }

    if( (empty($email_err) && empty($password_err) ) == 1)
    {
        $sql = "UPDATE movies_showtime SET available_seats = $seats_left WHERE movie_id = $movie_id AND ts_id = $ts_id AND showdate = '$date' AND showtime = '$time' ";

         if(mysqli_query($link, $sql)){
                
            $form_of_payment = "Paypal";

            $update = "UPDATE tickets SET food_price = $total_price_food, total_price = $total_price, form_of_payment = '$form_of_payment' WHERE ticket_id = $ticket_id"; 

            if(mysqli_query($link, $update)){


                                $points = $movie_totalprice / 150;
                                $_SESSION['total_points'] = $_SESSION['total_points'] + $points;
                                $total_points = $_SESSION['total_points'];

                                $sql = "UPDATE customers SET points = $total_points WHERE id = $id";

                                if(mysqli_query($link, $sql)){
                                        
                                        header('Location: user_settings.php');
                                    } else {

                                        echo 'query error: '. mysqli_error($link);
                                    }
            } else {
                echo 'query error: '. mysqli_error($link);
            }

        } else {
            echo 'query error: '. mysqli_error($link);
        }

     }    
}




if(isset($_POST['ewallet_submit']))
{
    $_SESSION['ewallet_id'] = "";

    $ewallet = $_POST["ewallet"];
    $ewallet_id = trim($_POST["ewallet_id"]);

    if(empty($ewallet_id))
    {
       $ewallet_err = 'ID is required.';
    } elseif(!preg_match('/^[0-9]{11}+$/', $ewallet_id)){
        $ewallet_err = 'ID must be valid.';
    } else {
        $_SESSION['ewallet_id'] = $ewallet_id;
    }

    if( (empty($ewallet_err)) == 1)
    {
        $sql = "UPDATE movies_showtime SET available_seats = $seats_left WHERE movie_id = $movie_id AND ts_id = $ts_id AND showdate = '$date' AND showtime = '$time' ";

         if(mysqli_query($link, $sql)){
                
            $form_of_payment = $ewallet;

            $update = "UPDATE tickets SET food_price = $total_price_food, total_price = $total_price, form_of_payment = '$form_of_payment' WHERE ticket_id = $ticket_id"; 

            if(mysqli_query($link, $update)){

                    $points = $movie_totalprice / 150;
                    $_SESSION['total_points'] = $_SESSION['total_points'] + $points;
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
            echo 'query error: '. mysqli_error($link);
        }
     }    
}



?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Confirm Payment</title>
        <link rel="stylesheet" href="css/bootstrap-4.5.3/css/bootstrap.min.css">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <link rel="stylesheet" href="css/styles_confirmpayment.css">
    </head>
    
    <body class='snippet-body'>



    <div class="container py-5">

    <a href="user_settings.php">
                        <button type="button" class="btn btn-secondary">Go Back</button> </a>

    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Confirm Payment</h1>
            <h1 class="display-6">Total Price: ₱ <?php echo $total_price ?></h1>
            <h3> 
        </div>
    </div> <!-- End -->

    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class="pt-4 pl-2 pr-2 pb-2">

                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item rounded"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit/Debit Card </a> </li>
                            <li class="nav-item rounded"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                            <li class="nav-item rounded"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a> </li>
                        </ul>
                    </div> <!-- End -->

                    <!-- Credit card form content -->
                    <div class="tab-content">

                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                <div class="form-group"> <label for="username">

                                        <h6>Card Owner</h6>

                                    </label> <input type="text" name="username" placeholder="Card Owner Name" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION['cardname']);?>"> <span class="invalid-feedback"><?php echo $username_err; ?></span> 
                                </div>



                                <div class="form-group"> <label for="cardNumber">

                                        <h6>Card number</h6>
                                    </label>

                                    <div class="input-group"> <input type="number" name="cardNumber" placeholder="Valid card number" class="form-control <?php echo (!empty($cardNumber_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION["creditcardnum"]); ?>"> 

                                        <div class="input-group-append"> <span class="input-group-text text-muted" value=""> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> <i class="fab fa-cc-discover mx-1"></i> </span> </div> <span class="invalid-feedback"><?php echo $cardNumber_err; ?></span>
                                        
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">

                                                    <h6>Expiration Date</h6>
                                                </span></label>

                                             <input type="number" placeholder="MM" name="mm" class="form-control <?php echo (!empty($mm_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION["mm"]); ?>"> <span class="invalid-feedback"><?php echo $mm_err; ?></span>


                                            <input type="number" placeholder="YY" name="yy" class="mt-4 form-control <?php echo (!empty($yy_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION["yy"]); ?>"> <span class="invalid-feedback"><?php echo $yy_err; ?></span>  

                                        </div>

                                
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>

                                            </label>  
                                                    
                                             <input type="number" name="cvv" class="form-control <?php echo (!empty($cvv_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION["cvv"]); ?>"> <span class="invalid-feedback"><?php echo $cvv_err; ?></span> 


                                        </div>

                                    </div>
                                </div>

                                        <p class="text-muted mb-2">Note: You cannot cancel the confirmed ticket. Also, no refunds. </p>  
                                <div class="card-footer"> 
                                     <button type="submit" name="credit_card_submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>

                            </form>
                             
                        </div>
                    </div> <!-- End -->


                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3">

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <h6 class="pb-2">Email</h6>

                            <div class="form-group "> <input type="text" name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION["paypal_email"]); ?>">  <span class="invalid-feedback"><?php echo $email_err; ?></span> </div>

                            <h6 class="pb-2">Password</h6>

                            <div class="form-group "> <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION["paypal_password"]); ?>"> <span class="invalid-feedback"><?php echo $password_err; ?></span>  </div>


                            <p> <button type="submit" name="paypal_submit" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Pay with Paypal</button> </p>
                         </form>
                        <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                    </div> <!-- End -->


                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                <div class="form-group "> <label for="Select Your Bank">
                                    <h6>Select E-Wallet</h6>
                                </label> 
                                    <select class="form-control" id="ccmonth" name="ewallet" required>
                                    <option value="" selected disabled>Select E-wallet</option>
                                    <option value="Paymaya">Paymaya</option>
                                    <option value="Gcash">Gcash</option>
                                    <option value="Coins.ph">Coins.ph</option>
                                </select> 

                                 <div class="form-group mt-4"> <input type="number" name="ewallet_id" placeholder="Input ID" class="form-control <?php echo (!empty($ewallet_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($_SESSION["ewallet_id"]); ?>"> <span class="invalid-feedback"><?php echo $ewallet_err; ?></span>  </div>

                            </div>


                            <div class="form-group">
                            <p> <button type="submit" name="ewallet_submit" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment </button> </p>
                            </div>
                        </form>
                        <p class="text-muted">Note: After clicking on the button, you will be directed to a secure gateway for payment depending on the chosen bank. </p>
                    </div> <!-- End -->
                    <!-- End -->
                </div>
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

    </div>


        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>

        <script type='text/javascript'>$(function() {
                $('[data-toggle="tooltip"]').tooltip()
                })</script>

    </body>
</html>