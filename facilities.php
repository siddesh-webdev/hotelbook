<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include("link.php");
    ?>
    <title><?php echo $setting_r['title'] ?> - Facilities</title>
   <style>
    .pop:hover{
        border-top-color: var(--teel) !important;
        transform: scale(1.03);
        transition: all 0.3s;
    }
   </style>
</head>
<body class="bg-light">
       <?php
       include("header.php");
       ?>
       
          <!-- Our facilities -->
         <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center">Our Facilities</h2>
            <div class="h-line bg-dark">

            </div>
            <p class="text-center mt-3">
            Welcome, where your comfort and convenience are our top priorities.<br>We take pride in offering a range of exceptional amenities and facilities designed to elevate your stay and make it truly memorable.</p>
         </div>
         
         
         <div class="container">
            <div class="row">
                <?php
                $res=selectAll('facilities');
                $path= FACILITIES_IMG_PATH;
                while($row = mysqli_fetch_assoc($res))
                {
                    echo<<<data
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex align-items-center mb-2">
                            <img src="$path$row[icon]" width="40px">
                            <h5 class="m-0 ms-3">$row[name]</h5>
                        </div>    
                        
                        <p>$row[description]</p>
                        </div>
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
