<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
      include("link.php");
      ?>
    <title><?php echo $setting_r['title'] ?> -Booking Status</title>
</head>
<body class="bg-light">
       <?php
       include("header.php");
       ?>
         <div class="container">
            <div class="row">
               <div class="col-12 my-5 mb-3 px-4">
                  <h2 class="fw-bold">Payment Status</h2> 
               </div>
               
                <?php
                  

                  if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
                  {
                     redirect('index.php');
                  }

                  $booking_q="SELECT bo.*,bd.* FROM `booking_order` bo 
                   INNER JOIN `booking_details` bd ON bo.booking_id=bd.booking_id WHERE bo.user_id=? AND bo.booking_status!=?";

                  $booking_res= select($booking_q,[$_SESSION['uId'],'pending'],'is');

                 $booking_fetch = mysqli_fetch_assoc($booking_res);


                 if($booking_fetch['trans_status']=="success")
                 {
                     echo<<< data
                        <div class="col-12 px-4">
                           <p class="fw-bold alert alert-danger">
                           <i class="bi bi-check-circle-fill"></i>
                           Payment failed!
                           <br><br>
                           <a href="bookings.php"> Go to Bookings</a>
                           </p>
                        </div>
                     data;
                 }
                 else
                 {
                  echo<<< data
                        <div class="col-12 px-4">
                           <p class="fw-bold alert alert-danger">
                           <i class="bi bi-exclamation-triangle-fill"></i>
                             Payment failed! $booking_fetch[trans_resp_msg]
                           <br><br>
                           <a href="bookings.php"> Go to Bookings</a>
                           </p>
                        </div>
                     data;

                 }

               ?>
              
         </div>
        </div>

      
          <!-- footer -->
         <?php
         include("footer.php");
         ?>
         
</body>
</html>
