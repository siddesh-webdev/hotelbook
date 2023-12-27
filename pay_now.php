
<?php
include("admin/connection.php");
include("admin/essential.php");

date_default_timezone_set("Asia/Kolkata");

session_start();

$ORDER_ID ='ORD_'.$_SESSION['uId'].random_int(11111,9999999);
$CUST_ID = $_SESSION['uId'];
$INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
$CHANNEL_ID = CHANNEL_ID;
$TXN_AMOUNT= $_SESSION['room']['payment'];

if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
{
   redirect('rooms.php');
}

if(isset($_POST['pay_now']))
{
   
    //insert payment data into database 

    $frm_data = filteration($_POST);
    
    $query1="INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`order_id`) VALUES (?,?,?,?,?)";

    insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],$frm_data['checkout'],$ORDER_ID],'issss');

    $booking_id = mysqli_insert_id($cn);
    
    $query2="INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";
    
    insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],$TXN_AMOUNT,$frm_data['name'],$frm_data['phonenum'],$frm_data['address']],'issssss');

    //insert payment data into database


    
}


//for title
$setting_q= "SELECT * FROM `settings` WHERE `id`=?";
$values=[1];
$setting_r = mysqli_fetch_assoc(select($setting_q,$values,'i'));

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            var order_id= "<?php echo $ORDER_ID;?>";
            var amt="<?php echo $TXN_AMOUNT ?>";
            jQuery.ajax({
                url:'pay_status.php',
                type:'POST',
                data: {'order':order_id},
                success:function(result){
                    var options = {
                            "key": "rzp_test_6uFZuHhsNwB5n3", 
                            "amount": "<?php echo $TXN_AMOUNT*100?>", 
                            "currency": "INR",
                            "name": "<?php echo $setting_r['title']?>",
                            "description": "Test Transaction",
                            "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                            "modal": {
                                "ondismiss": function(){
                                    window.location.replace("pay_failed.php");
                              }
                             },                           
                            "handler": function (response){ 
                                               
                            jQuery.ajax({
                                url:'pay_response.php',
                                type:'POST',
                                data: {'payment_id':response.razorpay_payment_id,'order_id':order_id,'amt':amt},
                                success:function(result){
                                    console.log(result);                               
                                    window.location.href="pay_status.php?order="+order_id;                        
                                }
                            
                            });
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
            }
        });
    
    </script>

     


