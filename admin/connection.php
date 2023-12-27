<?php
$cn=mysqli_connect("localhost","root");
$db=mysqli_select_db($cn,"hotelweb");
if(!$cn)
{
die("cannot conneted".mysqli_connect_error());
}

//for input filteration of admin login process 
function filteration($data)
{
    foreach($data as $key => $value ){
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
   
    $data[$key] = $value;
    }
    return $data;
}

function select($sql,$values,$datatypes)
{
 $cn=$GLOBALS['cn'];
 if($stmt=mysqli_prepare($cn,$sql))
 {
   mysqli_stmt_bind_param($stmt,$datatypes,...$values);
    if(mysqli_stmt_execute($stmt)){
     $res= mysqli_stmt_get_result($stmt);
     mysqli_stmt_close($stmt);
     return $res;
   }
   else
    {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed -Select");
    }

 }
 else
  {
    die("Query cannot be Prepared -Select");
  }
}

function update($sql,$values,$datatypes)
{
 $cn=$GLOBALS['cn'];
 if($stmt=mysqli_prepare($cn,$sql))
 {
   mysqli_stmt_bind_param($stmt,$datatypes,...$values);
    if(mysqli_stmt_execute($stmt)){
     $res= mysqli_stmt_affected_rows($stmt);
     mysqli_stmt_close($stmt);
     return $res;
    }
    else
    {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed -Update");
    }
    }
 else
  {
    die("Query cannot be Prepared -Update");
  }
}

function insert($sql,$values,$datatypes)
{
 $cn=$GLOBALS['cn'];
 if($stmt=mysqli_prepare($cn,$sql))
 {
   mysqli_stmt_bind_param($stmt,$datatypes,...$values);
    if(mysqli_stmt_execute($stmt)){
     $res= mysqli_stmt_affected_rows($stmt);
     mysqli_stmt_close($stmt);
     return $res;
    }
    else
    {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed -Insert");
    }
    }
 else
  {
    die("Query cannot be Prepared -Insert");
  }
}

function selectAll($table)
{
  $con= $GLOBALS['cn'];
  $res = mysqli_query($con,"SELECT * from $table");
  return $res;
}

function delete($sql,$values,$datatypes)
{
 $cn=$GLOBALS['cn'];
 if($stmt=mysqli_prepare($cn,$sql))
 {
   mysqli_stmt_bind_param($stmt,$datatypes,...$values);
    if(mysqli_stmt_execute($stmt)){
     $res= mysqli_stmt_affected_rows($stmt);
     mysqli_stmt_close($stmt);
     return $res;
    }
    else
    {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed -Delete");
    }
    }
 else
  {
    die("Query cannot be Prepared -Delete");
  }
}
?>