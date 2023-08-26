<?php

$conn = mysqli_connect('localhost','root','','multipleimage');

if(!$conn){
  echo 'Connection failed';
}

if(isset($_POST['submit'])){
  $imageCount = count($_FILES['image']['name']);

  for($i = 0 ;$i< $imageCount; $i++){
    $imagename = $_FILES['image']['name'][$i];
    $imageTempname = $_FILES['image']['tmp_name'][$i];
    $target = "./pmgpic/".$imagename;

    if(move_uploaded_file($imageTempname, $target)){
      $sql = "INSERT INTO multipic(image)VALUES('$imagename')";
      $result = mysqli_query($conn,$sql);
    }
  }
  if($result){
     header('location:index.php?msg=ins');
  }

 
}


?>


<!DOCTYPE html>
<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body class="w3-light-grey">

<div class="w3-content" style="max-width:1400px">


<header class="w3-container w3-center w3-padding-32"> 
  <h1><b>Upload Multiple Images</b></h1>
  
</header>


<div class="w3-row">


<div class="w3-col l8 s12">

  <div class="w3-card-4 w3-margin w3-white">
    
    <div class="row">
      <form action="index.php" method="POST" enctype="multipart/form-data">
               <div class="col-md-4">
                   <div class="form-group">
                  
                    <input type="file" name="image[]" multiple  > <br><br>
                   </div>
               </div>
               <?php 
                  if(isset($_GET['msg']) AND $_GET['msg']=='ins'){
                     echo '<h3>Your Image Uploaded ... Thank You</h3>';
                  }
                ?>
                <div class="col-md-4">
                    <div class="form-group" style="background-color:gold">
                         <input type="submit" name="submit"  value="Upload"> 
                        
                    </div>
                </div>
</form>

<?php  
   $sql = "SELECT * FROM multipic";
   $result = mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)>0){
    while($fetch = mysqli_fetch_assoc($result)){
        ?>
        <img src="pmgpic/<?php echo $fetch['image']; ?>" width = "100" height="100" alt="Nature" >

        <?php
    }

   }

?>
            </div>
  </div>
  <hr>


  <div class="w3-card-4 w3-margin w3-white">

    
   
    
  </div>

</div>





  
  <!-- Posts -->
  
  <hr> 
 

    <div class="w3-container w3-padding">
      <h3>Made By Omkareshwar Halli</h3>
    </div>
 
    

  

</footer>

</body>
</html>















