

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile picture</title>
    <link rel="stylesheet"  href="Dashboard.css">
</head>
<body>
	<?php
    session_start();
    $ImgErr=$Name=$Image="";
    $isset=false;

    if(isset($_SESSION['un'])){
        $currentdata = file_get_contents("information.json");  
        $currentdata = json_decode($currentdata, true); 
        foreach($currentdata as $key=>$value){
            if($value['Username']==$_SESSION["un"])
            {
            $Name=$value['Name'];
            $oldImage=$value['Image']; 
            $Gender=$value['Gender'];
            $Username=$value['Username']; 
            $DOB=$value['DOB'];
            $isset=true;
            break;
            }
        }
        if($isset){
             $Confirm_msg="";
        }else{
             $Errmsg="Something did not match";
        }

	$pictureErr= "";
    $ImgErr = $UploadConfirmation = "";
    $target_file="";

    if(isset($_POST['submit'])){
        $target_dir = "pictures/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
       
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";    
        if($_FILES['fileToUpload']['name'] != "")
        {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                
                $uploaded = 1;
            } else {
                $ImgErr = "File is not an image.";
                $uploaded = 0;
            }
        
            if (file_exists($target_file)) {
                $ImgErr = "Sorry, file already exists.";
                $uploaded = 0;
            }
        
            if ($_FILES["fileToUpload"]["size"] > 40000000000) {
                $ImgErr = "Sorry, this file is too large.";
                $uploaded = 0;
            }
        
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $ImgErr= "Only JPG, JPEG, PNG  files can be uploaded.";
                $uploaded = 0;
            }
        
            if ($uploadOk == 0) {
                $ImgErr = "Sorry, your file was not uploaded.";
            } 
            else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $UploadConfirmation = "File has been uploaded Successfully";

                    $filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                    $data = file_get_contents("information.json");

                    $data = json_decode($data, true);

                    if (!empty($data)) {

                        foreach ($data as $key => $row) {

                            if ($row["Username"] == $_SESSION['un']) {

                                $data[$key]['Image'] = $filepath;

                                $_SESSION['Image'] = $filepath;
                                $Image=$filepath;

                                break;

                            }

                        }



                        file_put_contents('information.json', json_encode($data));

                    }
                } else {
                    $ImgErr = "Sorry, there was an error uploading your file.";
                }
            }
        }else{
            $ImgErr="Select an image!";
        }
    }
}
    
    ?>
    <?php

 include 'Head.php';

   ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <br>
    <div class="intro">
        
        <br>
    <?php  
    
    echo "Logged in as , ".$Name;

    ?>
        
    
    <br>
    <a href="Login.php" target="_self" >Log out</a>
    <img class="intro2" src="<?php if(empty($Image)){echo $oldImage;}else{echo $Image;} ?>" width="120px" height="120px"><br><br>

    </div>
    
   <table border=1 style="width:800px; border-style: none;border-collapse: collapse;">
        
          

           
          <tr>
            
        <td  style="width:250px">
            <legend>Account<hr></legend>
            <ul >
                <li><a href="Dashboard.php">Dashboard</a></li>
                <li><a href="viewprofile.php">View Profile</a></li>
                <li><a href="editprofile.php">Edit Profile</a></li>
                <li><a href="Profile Picture.php">Change Profile Picture</a></li>
                <li><a href="Change Password.php">Change Password</a></li>
                <li><a href="Login.php">Log out</a></li>
            </ul>
        </td>
    <td  style="width:550px; vertical-align:top;">
            
            <br> </br>
            &nbsp; &nbsp;
            
                <h2>Change profile picture</h2>
          <img src="<?php if(!empty($filepath)){echo $filepath;}else{ echo $oldImage;} ?>" alt="" width="300px" height="300px"><br>
          <?php
                    if ($ImgErr) {
                        echo ($ImgErr);
                    }
                    ?>
                    
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <hr>
                
                    
                    
                <input type="submit" name="submit"  value="Submit">
           </td>
        
        </tr>
    </table> 
   </div>
  </form>
  <?php
                      include "Footer.php";
                    ?>



</body>
</html>