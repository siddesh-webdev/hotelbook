<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">                     
<link rel="stylesheet" href="css/common.css">

<?php
session_start();

date_default_timezone_set("Asia/Kolkata");

include("admin/connection.php");
include("admin/essential.php");

$contact_q= "SELECT * FROM `contact` WHERE `id`=?";
$setting_q= "SELECT * FROM `settings` WHERE `id`=?";
$values=[1];
$contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
$setting_r = mysqli_fetch_assoc(select($setting_q,$values,'i'));


if($setting_r['shutdown']){
 echo<<< alertbar
  <div class='bg-danger text-center p-2 fw-bold'>
  <i class="bi bi-exclamation-triangle-fill"></i> Bookings are temporarily closed!
  </div>

 alertbar;

}
?>
 