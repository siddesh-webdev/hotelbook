<?php
include("essential.php");
include("connection.php");
adminLogin();
session_regenerate_id(true);

if(isset($_GET['seen']))
{
  $frm_data=filteration($_GET);

  if($frm_data['seen']=='all')
  { 
    $q="UPDATE `rating_review` SET `seen`=?";
    $values=[1];
    if(update($q,$values,'i'))
    {
      alert('success','Marked all as read');
    }
    else
    {
      alert('error','Operation Failed !');
    }
   }
  
  else{
    $q="UPDATE `rating_review` SET `seen`=? WHERE `id`=?";

    $values=[1,$frm_data['seen']];
    if(update($q,$values,'ii')) {
      alert('success','Marked as read');
    }
    else{
      alert('error','Operation Failed !');
    }
  }
}

if(isset($_GET['del']))
{
  $frm_data=filteration($_GET);

  if($frm_data['del']=='all'){ 
    $q="DELETE FROM `rating_review`";
    
    if(mysqli_query($cn,$q)) {
      alert('success','All Data deleted!');
    }
    else{
      alert('error','Operation Failed !');
    }
  }
  else{
    $q="DELETE FROM `rating_review` WHERE `id`=?";
    $values=[$frm_data['del']];
    if(delete($q,$values,'i')) {
      alert('success','Data deleted!');
    }
    else{
      alert('error','Operation Failed !');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Ratings & Reviews</title>
    <?php
     include("link.php");

    ?>
   
</head>
<body class="bg-light">

<?php
include("header.php");
?>
  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">Ratings & Reviews</h3>
       
            <div class="card border-0 shadow mb-4" >
              <div class="card-body">
                <div class="text-end mb-4">
                  <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm"><i class="bi bi-check-all"></i> Mark all read</a>
                  <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm"><i class="bi bi-trash"></i> Delete all</a>
                </div>
                <div class="table-responsive-md">
                <table class="table table-hover border">
                    <thead class="sticky-top">
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Room Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Rating</th>
                        <th scope="col" width="30%">Review</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $q="SELECT rr.*,uc.name as uname,r.name as rname from `rating_review` rr
                      inner join `user_cred` uc on rr.user_id = uc.id
                      inner join `rooms` r on rr.room_id = r.id
                      order by `id` desc ";
                      $data=mysqli_query($cn,$q);
                      $i=1;
                      while($row=mysqli_fetch_array($data))
                      {
                        $date= date('d-m-Y',strtotime($row['datentime']));

                          $seen='';
                          if($row['seen']!=1){
                            $seen= "<a href='?seen=$row[id]' class='btn btn-sm rounded-pill btn-primary mb-2'>Mark as read</a><br>";
                          }
                          $seen.="<a href='?del=$row[id]' class='btn btn-sm rounded-pill btn-danger '>Delete</a>";

                      echo <<<query
                        <tr>
                       <td>$i</td>
                       <td>$row[rname]</td>
                       <td>$row[uname]</td>
                       <td>$row[rating]</td>
                       <td>$row[review]</td>
                       <td>$date</td>
                       <td>$seen</td>
                        </tr>
                      query;
                      $i++;
                      }
                      ?>
                    </tbody>
                  </table> 
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>

<?php
include("script.php");
?>

</body>
</html>