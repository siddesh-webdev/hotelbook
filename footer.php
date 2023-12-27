<div class="container-fluid bg-white mt-5">
            <div class="row">
                <div class="col-lg-4 p-4">
                    <h3 class="h-font fw-bold fs-3 mb-2" ><?php echo $setting_r['title'] ?></h3>
                    <p><?php echo $setting_r['about'] ?></p>
                </div>
                <div class="col-lg-4 p-4">
                    <h5 class="mb-3">Links</h5>
                    <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
                    <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
                    <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
                    <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
                    <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
                                    
                </div>
                <div class="col-lg-4 p-4">
                    <h5 class="mb-3">Follow Us</h5>
                    <a href="<?php echo $contact_r['tw'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none ">
                        <i class="bi bi-twitter"></i> Twitter
                    </a><br>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none ">
                        <i class="bi bi-facebook"></i> Facebook
                    </a><br>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none ">
                        <i class="bi bi-instagram"></i> Instagram
                    </a><br>


                </div>
            </div>

          </div>
       <h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed By Siddesh</h6>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

    function alert(type,msg,position='body')
    {
        let bs_class=(type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML= `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong>${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

        if( position =='body')
        {
            document.body.append(element);
            element.classList.add('custom-alert');

        }
        else{
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert,3000);

    }
    function remAlert()
    {
        document.getElementsByClassName('alert')[0].remove();
    }

function setActive()
{
let navbar= document.getElementById('nav-bar');
let a_tags = navbar.getElementsByTagName('a');

for(i=0;i<a_tags.length;i++)
{
    let file= a_tags[i].href.split('/').pop();
    let file_name =file.split('.')[0];
    if(document.location.href.indexOf(file_name)>=0){
        a_tags[i].classList.add('active');
    }
}
}



let register_form = document.getElementById('register-form');

register_form.addEventListener('submit',(e)=>{
    e.preventDefault();

 let data= new FormData();
 data.append('name',register_form.elements['name'].value);
 data.append('email',register_form.elements['email'].value);
 data.append('phonenum',register_form.elements['phonenum'].value);
 data.append('address',register_form.elements['address'].value);
 data.append('profile',register_form.elements['profile'].value);
 data.append('pincode',register_form.elements['pincode'].value);
 data.append('dob',register_form.elements['dob'].value);
 data.append('pass',register_form.elements['pass'].value);
 data.append('cpass',register_form.elements['cpass'].value);
 data.append('profile',register_form.elements['profile'].files[0]);
 data.append('register','');

 var myModal = document.getElementById('RegisterModel');
 var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
 modal.hide();

 let xhr = new XMLHttpRequest();

 xhr.open('POST','ajax/login_register.php',true);

 xhr.onload = function(){

    if(this.responseText == 'pass_mismatch')
    {
        alert('error',"Wrong Password!");
    }
    else if(this.responseText == 'email_already')
    {
        alert('error',"Email Already Exists!");
    }
    else if(this.responseText == 'phone_already')
    {
        alert('error',"Phone Number Already Exists!");
    }
    else if(this.responseText == 'inv_img')
    {
        alert('error',"Only JPG, WEBP & PNG allowed");
    }
    else if(this.responseText == 'upd_failed')
    {
        alert('error',"Image Upload Failed");
    }
    else if(this.responseText == 'mail_failed')
    {
        alert('error',"Cannot send confirmation mail!");
    }
    else if(this.responseText == 'ins_failed')
    {
        alert('error',"Registration failed");
    }
    else{
        alert('success',"Registration Successful. Confirmation send to email!");
        register_form.reset();
    }

 }

 xhr.send(data);

});

let login_form = document.getElementById('login-form');

login_form.addEventListener('submit',(e)=>{
    e.preventDefault();

 let data= new FormData();

 data.append('email_mob',login_form.elements['email_mob'].value);
 data.append('pass',login_form.elements['pass'].value);
 data.append('login','');

 var myModal = document.getElementById('LoginModel');
 var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
 modal.hide();

 let xhr = new XMLHttpRequest();

 xhr.open('POST','ajax/login_register.php',true);

 xhr.onload = function(){

    if(this.responseText == 'inv_email_mob')
    {
        alert('error',"Invalid Email or Mobile number!");
    }
    else if(this.responseText == 'not_verified')
    {
        alert('error',"User is not Verified");
    }
    else if(this.responseText == 'inactive')
    {
        alert('error',"Account Inactive Please Contact Support!");
    }
    else if(this.responseText == 'invalid_pass')
    {
        alert('error',"Wrong Password!");
    }
    else
    {
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if(fileurl == 'room_details.php')
        {
            window.location =window.location.href;
        }
        else{
        window.location = window.location.pathname;
        }
    }

 }

 xhr.send(data);

});


let forgot_form = document.getElementById('forgot-form');
 forgot_form.addEventListener('submit',(e)=>{
    e.preventDefault();

 let data= new FormData();

 data.append('email',forgot_form.elements['email'].value);

 data.append('forgot_pass','');

 var myModal = document.getElementById('forgotModel');
 var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
 modal.hide();

 let xhr = new XMLHttpRequest();

 xhr.open('POST','ajax/login_register.php',true);


 xhr.onload = function(){

    if(this.responseText == 'inv_email')
    {
        alert('error',"Invalid Email!");
    }
    else if(this.responseText == 'not_verified')
    {
        alert('error',"User is not Verified");
    }
    else if(this.responseText == 'inactive')
    {
        alert('error',"Account Inactive Please Contact Support!");
    }
    else if(this.responseText == 'mail_failed')
    {
        alert('error',"Cannot send Email!");
    }
    else if(this.responseText == 'upd_failed')
    {
        alert('error',"Account recovery failed!");
    }
    else
    {
        alert('success',"Reset email send to email!");
        forgot_form.reset();
    }

 }

 xhr.send(data);

});

function checkLoginToBook(status,room_id)
{
    if(status)
    {
    window.location.href='confirm_booking.php?id='+room_id;
    
    }
    else{
        alert('error','Please login to book room!');
    }

}

setActive();
</script>