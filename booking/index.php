<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

        <link src="admin/font-awesome/css/all.js"/>

        <script src="admin/vendor/jquery/jquery.min.js"></script>

        <script src="admin/font-awesome/js/all.js"></script>
       
        <link href="css/styles.css" rel="stylesheet" />

    </head>

   <body>
        <div style="margin: 0 auto;">
    <?php
       $page = isset($_GET['page']) ? $_GET['page'] : 'movie_carousel';
       include($page.'.php');
    ?>
          </div>
           
    
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    </body>

</html>
