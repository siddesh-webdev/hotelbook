<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include("link.php");
    ?>
    <title><?php echo $setting_r['title'] ?> - Contact Us</title>
</head>
<body class="bg-light">
    <?php
     include("header.php");
     ?>
       
          <!-- Our facilities -->
         <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center">Contact Us</h2>
            <div class="h-line bg-dark">

            </div>
            <p class="text-center mt-3">Our team is dedicated to providing exceptional service and making your stay truly memorable.<br> We look forward to welcoming you soon!</p>
         </div>
       
         
         <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-5 px-4">
                    <div class="bg-white rounded shadow p-4">
                     <iframe class="w-100 rounded mb-4" height="320px" src="<?php echo $contact_r['iframe']  ?>" loading="lazy"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gmap']  ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mt-2"><i class="bi bi-geo-alt-fill"></i> 515,Sadar Bazar,Near Ajinkya Hospital,Satara</a>
                    <h5 class="mt-3">Call Us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1']  ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1']  ?></a>
                   <br> <a href="tel: +<?php echo $contact_r['pn2']  ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn2']  ?></a>
                     <h5 class="mt-3">Email</h5>
                     <a href="mailto: <?php echo $contact_r['email']  ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-envelope-at-fill"></i> <?php echo $contact_r['email'] ?></a>
                     <h5 class="mt-3">Follow Us</h5>
                    <a href="<?php echo $contact_r['tw'] ?>" class="d-inline-block  text-dark fs-5 me-2">
                        
                            <i class="bi bi-twitter me-1"></i> 
                    </a>
                      <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-5 me-2">
                   
                        <i class="bi bi-facebook me-1"></i> 
                    </a>
                   
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block  text-dark fs-5  ">
                     
                            <i class="bi bi-instagram me-1"></i> 
                    </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 px-4">
                    <div class="bg-white rounded shadow p-4 ">
                     <form method="POST">
                        <h5>Send a Message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input type="text" name="name" class="form-control shadow-none" required>
                            
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" name="email" required class="form-control shadow-none">
                            
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input type="text" name="subject" required class="form-control shadow-none">
                            
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            
                            <textarea class="form-control shadow-none" name="message" required rows="5" style="resize:none;"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3">Send </button> 
                     </form>
                    </div>
                </div>
               
            </div>
        </div>

        <?php
        if(isset($_POST['send']))
        {
            $frm_data= filteration($_POST);
            $q="INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

            $res=insert($q,$values,'ssss');
            if($res==1)
            {
                alert('success','Mail sent..!');
            }
            else{
                alert('error','Server Down! Try again Later');
            }
        }  
        
        ?>

          <!-- footer -->
         <?php
         include("footer.php");
         ?>

     
</body>
</html>
