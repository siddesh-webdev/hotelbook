<?php
include("connection.php");
include("essential.php");

session_start();

if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
    redirect('dashboard.php');
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
<?php
include("link.php");
?>
<style>
    div.login-form{
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%,-50%);
     width: 400px;
 
    }
</style>

</head>
<body class="bg-light">

<div class="login-form text-center rounded overflow-hidden shadow">
    <form action="" method="POST">
        <h4 class="bg-dark text-white py-3">Admin Login </h4>
        <div class="p-4">
            <div class="mb-3">
               
                <input required name="admin_name" type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
                
            </div>
            <div class="mb-4">
                
                <input required name="admin_pass" type="password" class="form-control shadow-none text-center" placeholder="Password">
            </div>
            <button name="login" type="sumbit" class="btn text-white custom-bg shadow-none">Login</button>
        </div>
    </form>
</div>

<?php

if(isset($_POST['login']))
{
    $frm_data=filteration($_POST);
    
    $q="SELECT * from `admin_cred` where `name`=? and `password`=?";
    $values= [$frm_data['admin_name'],$frm_data['admin_pass']];
    
    $res= select($q,$values,"ss");
    if($res->num_rows==1)
    {
       $row=mysqli_fetch_assoc($res);
       
       $_SESSION['adminLogin']=true;
       $_SESSION['adminId']=$row['id'];
       redirect('dashboard.php'); 
    }
    else
    {
        alert('error','Login failed - Invalid Credentials');
    }
}


?>


<?php
include("script.php");
?>

</body>
</html>