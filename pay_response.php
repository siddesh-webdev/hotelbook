
<?php
include("admin/connection.php");
include("admin/essential.php");

date_default_timezone_set("Asia/Kolkata");

session_start();

unset($_SESSION['room']);

function regenerate_session($uid)
{
   $user_q= select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$uid],'i'); 

   $user_fetch = mysqli_fetch_assoc($user_q);

   $_SESSION['login'] =true;
   $_SESSION['uId'] =$user_fetch['id'];
   $_SESSION['uName'] = $user_fetch['name'];
   $_SESSION['uPic'] = $user_fetch['profile'];
   $_SESSION['uPhone'] = $user_fetch['phonenum'];

}


if(isset($_POST['payment_id'])  && isset($_POST['order_id']))
{
    $slct_query= "SELECT `booking_id`,`user_id` FROM `booking_order` WHERE `order_id`='$_POST[order_id]'";

    $slct_res= mysqli_query($cn,$slct_query);
    
    if(mysqli_num_rows($slct_res)==0){
        redirect('index.php');
    }
    $slct_fetch = mysqli_fetch_assoc($slct_res);

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
    {
     regenerate_session($slct_fetch['user_id']);
    }

    $upd_query="UPDATE `booking_order` SET `booking_status`= 'booked',`trans_id`='$_POST[payment_id]',`trans_amt`='$_POST[amt]',
    `trans_status`='success',`trans_resp_msg`='your payment has been sucess' WHERE  `booking_id`='$slct_fetch[booking_id]'";

    mysqli_query($cn,$upd_query);

    redirect('pay_status.php?order='.$_POST['order_id']);

    
  
}
else
{
    $slct_query= "SELECT `booking_id`,`user_id` FROM `booking_order` WHERE `order_id`='$_POST[order_id]'";

    $slct_res= mysqli_query($cn,$slct_query);
    
    if(mysqli_num_rows($slct_res)==0){
        redirect('index.php');
    }
    $slct_fetch = mysqli_fetch_assoc($slct_res);

    $query2="UPDATE `booking_order` SET `booking_status`= 'payment failed',`trans_id`='$_POST[payment_id]',`trans_amt`='$_POST[amt]',
    `trans_status`='failed',`trans_resp_msg`='your payment has been failed' WHERE  `booking_id`='$slct_fetch[booking_id]'";

    mysqli_query($cn,$upd_query);

    redirect('pay_status.php?order='.$_POST['order_id']);
}



?>