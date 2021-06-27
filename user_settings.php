<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: register/login.php");
    exit;
}


include "register/config.php";

$id = $_SESSION["id"];


$sql = "SELECT * 
FROM customers WHERE 
id = $id";

$result = mysqli_query($link, $sql);
$pizza = mysqli_fetch_assoc($result);

mysqli_free_result($result);
// mysqli_close($link);


 $sql = "SELECT * FROM tickets WHERE id = $id ORDER BY ticket_id";

    // get the result set (set of rows)
    $result = mysqli_query($link, $sql);

    // fetch the resulting rows as an array
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free the $result from memory (good practise)
    mysqli_free_result($result);


 $sql = "SELECT price FROM tickets WHERE id = $id ORDER BY ticket_id";

    // get the result set (set of rows)
    $result = mysqli_query($link, $sql);

    // fetch the resulting rows as an array
    $points = mysqli_fetch_all($result, MYSQLI_ASSOC);

      // free the $result from memory (good practise)
    mysqli_free_result($result);
    

    $total_points = 0;
    foreach($points as $point): 
        $total_points = $total_points + $point['price'] / 25; 
    endforeach;


if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['points_update']))
{ 
    $sql = "UPDATE customers SET points = '$total_points' WHERE id = '$id'";

        if(mysqli_query($link, $sql)){
                // success
                header('Location: user_settings.php');
            } else {
                echo 'query error: '. mysqli_error($link);
            }
}
   

// Include config file
require_once "register/config.php";
 
// Define variables and initialize with empty values

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

$phone = "";
 

// Processing form data when form is submitted
if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['password_submit']))
{
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err))
    {
        // Prepare an update statement
        $sql = "UPDATE customers SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);

}




if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['username_submit']))
{
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";

    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";

    }
      else
    {

        // Prepare a select statement
        $sql = "SELECT id FROM customers WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {

                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else
                    {
                        $username = trim($_POST["username"]);
                    }

            } else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
   
        // Prepare an update statement
    if(empty($username_err)) 
    {
            $sql = "UPDATE customers SET username = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_username, $param_id);
            
            // Set parameters
            $param_username = $username;
            $param_id = $_SESSION["id"];

            $_SESSION["username"] = $username;
            
            // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt))
              {
                  // Username updated successfully. Destroy the session, and redirect to login page
                 
                  header("location: user_settings.php");
                  exit();
              } 

            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}




if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['email_submit']))
{
     // Validate username
    if(empty(trim($_POST['email'])))
    {
        $email_err = "An email is required.";
    } 
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $email_err = "Email must be a valid email address.";
    }
      else 
    { 

        // Prepare a select statement
        $sql = "SELECT id FROM customers WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {

                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else
                    {
                        $email = trim($_POST["email"]);
                    }

            } else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
   
        // Prepare an update statement
    if(empty($email_err)) 
    {
            $sql = "UPDATE customers SET email = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_email, $param_id);
            
            // Set parameters
            $param_email = $email;
            $param_id = $_SESSION["id"];

            $_SESSION["email"] = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
              {
                // Email updated successfully. Destroy the session, and redirect to login page
                
                header("location: user_settings.php");
                exit();
              }

            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}




if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['address_submit']))
{
     // Validate username
   if(empty($_POST['address'])){
       $address_err = 'Address is required.';
    } 
    elseif(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $_POST['address'])) 
    {
        $address_err = "Address must be a comma separated list.";
    } 
    else 
    {
      $address = trim($_POST['address']);
    }
    
   
        // Prepare an update statement
    if(empty($address_err)) 
    {
            $sql = "UPDATE customers SET address = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_address, $param_id);
            
            // Set parameters
            $param_address = $address;
            $param_id = $_SESSION["id"];

            $_SESSION["address"] = $address;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
              {
                // address updated successfully. Destroy the session, and redirect to login page
                
                header("location: user_settings.php");
                exit();
              }

            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}




if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['phone_submit']))
{
     // Validate username
    $phone_ex =  $_POST['phone'];

    if(empty($_POST['phone'])){
       $phone_err = 'Phone Number is required.';
    } elseif(!preg_match('/^[0-9]{11}+$/', $phone_ex)){
        $phone_err = 'Phone Number must be valid.';
    } else {
        $phone = trim($_POST['phone']);
    }

    // Prepare an update statement
    if(empty($phone_err)) 
    {
            $sql = "UPDATE customers SET phone = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_phone, $param_id);
            
            // Set parameters
            $param_phone = $phone;
            $param_id = $_SESSION["id"];

            $_SESSION["phone"] = $phone;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
              {
                // phone updated successfully. Destroy the session, and redirect to login page
                
                header("location: user_settings.php");
                exit();
              }

            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User settings</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles_user.css">
</head>
<body>
    
    <header id="top_header" class="clearfix">
		<div class="wrapper">
			<h4 class="logo"> <img src="images/MMLP.png" class="logo" style="width:25px;height:25px;margin-right: 5px"> <a href="index.php">MMLP</a>   </h4>
			<nav id="main_nav">
                <a href="booking/booking.php">Book Now!</a>
                <a href="user_settings.php">User</a>
				<a href="movies.php">Movies</a>
				<a href="faq.php">FAQ</a>
			</nav>
		</div>
	</header>

 <h4 class="text-center font-weight-bold mb-4">Pending Tickets for Confirmation:</h4>
    <div class="container">
        <div class="row">

            <?php foreach($tickets as $ticket): ?>

                    <div class="card mx-1 my-1"  style="width: 15rem;">
                        <div class="card-content text-center mt-3">

                        <h4> Ticket ID: <?php echo htmlspecialchars($ticket['ticket_id']); ?></h4>
                       <!--  <h4> Booking Date: <?php echo htmlspecialchars($ticket['date']); ?></h4>
                        <h4> Booking Time: <?php echo htmlspecialchars($ticket['time']); ?></h4> -->
                        <h4> Total price: ₱ <?php echo htmlspecialchars($ticket['price']); ?></h4>

                        </div>

                        <div class="card-body text-center">
                            <a href="payment.php?id=<?php echo $ticket['ticket_id'] ?>">
                            <button type="button" class="btn btn-outline-info">More details</button></a>
                        </div>


                    </div>

            <?php endforeach; ?>

        </div>
    </div> 
    


<div class="container container-p-y">
    <h4 class="font-weight-bold pb-2 mb-3 mt-4 text-center">
      User Settings
    </h4>



    <div class="card overflow-hidden">
      <div class="row no-gutters">
        <div class="col-md pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-connections">Points</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">Notifications</a>
          </div>
            
        </div>
        <div class="col-md">
          <div class="tab-content">

            <div class="tab-pane fade active show" id="account-general">
              <div class="card-body media">

                <img src="images/user.png" alt="" class="d-block ui-w-80">
                <div class="media-body ml-4">
                  <label class="btn btn-outline-primary">
                    Upload new photo
                    <input type="file" class="account-settings-fileinput">
                  </label> &nbsp;
                  <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>

              </div>
              <hr class="border-light m-0">

              <div class="card-body">
                <div class="form-group">
                  <label class="form-label">Current Username: &nbsp <?php echo htmlspecialchars($_SESSION["username"]); ?></label>

                    <!-- Username -->

                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                        <div class="form-group">
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>

                        <!-- Submit button to update username -->

                        <button type="submit" type="input" name="username_submit" class="btn btn-outline-secondary mt-1"> Change Username</button>
                    </form>


                </div>
                  
              <div class="form-group">
                <label class="form-label">Current E-mail: &nbsp <?php echo htmlspecialchars($pizza['email']); ?></label>

                    <!-- E-mail -->

                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                        <div class="form-group">
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value=""> 
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>

                        <!-- Submit button to update email -->

                        <button type="submit" type="input" name="email_submit" class="btn btn-outline-secondary mt-1"> Change email</button>
                    </form>



                </div>
              </div>
            </div>
              
            <div class="tab-pane fade" id="account-change-password">
                <div class="card-body pb-2">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 

                          <div class="form-group">
                            <label>New Password</label>

                              <!-- check if error message is empty or not -->

                               <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">

                               <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                          </div>

                          <div class="form-group">
                            <label>Confirm Password</label>

                                <!-- check if error message is empty or not -->

                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                          </div>

                          <!-- Submit button for change password -->

                          <div class="form-group">
                                <input type="submit" name="password_submit" class="btn btn-primary" value="Submit">
                          </div>

                   </form>
              </div>
            </div>
              

            <div class="tab-pane fade" id="account-info">
              <div class="card-body">


                  <div class="form-group">
                    <label class="form-label">Current Address: &nbsp <?php echo htmlspecialchars($pizza['address']); ?></label>

                      <!-- Address -->

                       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                          <div class="form-group">
                              <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value=""> 
                              <span class="invalid-feedback"><?php echo $address_err; ?></span>
                          </div>

                          <!-- Submit button to update address -->

                          <button type="submit" type="input" name="address_submit" class="btn btn-outline-secondary mt-1"> Update address</button>
                      </form>
                  </div>
                </div>

              <hr class="border-light m-0">
                
              <div class="card-body">
                <h6 class="mb-4">Phone Number: &nbsp <?php echo htmlspecialchars($pizza['phone']); ?></h6>

                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                          <div class="form-group">
                              <input type="text" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value=""> 
                              <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                          </div>

                          <!-- Submit button to update phone number -->

                          <button type="submit" type="input" name="phone_submit" class="btn btn-outline-secondary mt-1"> Update phone</button>
                      </form>


              </div>
            </div>
              
              
            <div class="tab-pane fade" id="account-connections">
                
            <hr class="border-light m-0">
               
              <div class="card-body">    
                <h6 class="mb-4">Unconfirmed Points (Based on Tickets Bought):</h6>
                <div class="form-group">
                  <label class="form-label">Gained Points</label>
  
                  <p class="font-weight-bold text-info"> <?php echo $total_points ?> </p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="points"> 
                        <button type="submit" type="input" name="points_update" class="btn btn-outline-secondary mt-1"> Save Points </button>
                    </form>

                </div>
              </div>
                
            <hr class="border-light m-0">
                
              <div class="card-body">
                <h6 class="mb-4">Want to Add Food?</h6>
                <a href="food-ordering.php">
                <button type="button" class="btn btn-twitter">Go to <strong>Food</strong></button></a>
              </div>

              <hr class="border-light m-0">
                
              <div class="card-body">
                <h6 class="mb-4">Want to Book a Movie?</h6>
                <a href="booking/booking.php">
                <button type="button" class="btn btn-facebook">Go to <strong>Movies</strong></button></a>
              </div>
            
                
            </div>
              
            <div class="tab-pane fade" id="account-notifications">
                
              <div class="card-body pb-2">

                <h6 class="mb-4">Activity</h6>

                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked="">
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Email me when movie booking is close</span>
                  </label>
                </div>
                  
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked="">
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Email me when movie got cancelled</span>
                  </label>
                </div>
                  
                </div>
                
              <hr class="border-light m-0">
              <div class="card-body pb-2">

                <h6 class="mb-4">Application</h6>

                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked="">
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">News and announcements</span>
                  </label>
                </div>
                  
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input">
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Weekly featured movies</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="switcher">
                    <input type="checkbox" class="switcher-input" checked="">
                    <span class="switcher-indicator">
                      <span class="switcher-yes"></span>
                      <span class="switcher-no"></span>
                    </span>
                    <span class="switcher-label">Weekly bonus points</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-right mt-3">
      <a href="register/logout.php" type="button" class="btn btn-danger ml-3">Sign Out of Your Account</a>
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
    
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
<script type="text/javascript">
  

</script>
    
</body>
</html>