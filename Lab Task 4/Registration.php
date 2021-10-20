<!DOCTYPE html>
<html ang="en" class="notranslate" translate="no">
<head>
    
    
    <meta name="google" content="notranslate" />
    
    <title>Do Registration first!</title>
</head>
<body style="background-color:skyblue;">
    <?php

include 'Head.php';

?>

    <?php

    $name = $email =$un=$gender=$pass=$Cpass=$dob="";
    
    $UploadConfirmation = "";
    $target_file="";

    
    $nameErr =$emailErr=$unErr=$genderErr=$passErr=$CpassErr=$dobErr=$pictureErr=$ImgErr="";
    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
         $name_count = $_POST["name"];
         $username_count=$_POST["un"];
         $Name = $_POST['name'];
         $Email= $_POST['email'];
         $Username= $_POST['un'];
         $Password = $_POST['pass'];
        $Gender =$_POST['gender'];

         $target_dir = "pictures/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
       
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";


         
          if (empty($_POST["name"])) 
        {
            $nameErr = "Name is required";
        } 
        else {
            $name = test_Input($_POST["name"]);
            if ((!preg_match("/^[a-zA-Z-'. ]*$/", $name)) or (str_word_count($name_count) < 2)) {
                $nameErr = "At least two words and Alphabets only";
            }
        }

         if (empty($_POST["email"])) 
        {
            $emailErr = "Email is required";
        } 


        else 
        {
            $email = test_Input($_POST["email"]);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
         {
            $emailErr= "Invalid Email !";
        }
    }
    if (empty($_POST["gender"])) 
    {
    $genderErr = "Gender is required";
    } 
    else 
    {
    $gender = test_input($_POST["gender"]);
     }
     
     if (empty($_POST["pass"])) 
    {
    $passErr = "Please enter password";
    } 
    else 
    {
    $pass = test_input($_POST["pass"]);

      if (strlen($_POST["pass"]) < 8) {
        $passErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["pass"])) {
        $passErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["pass"])) {
        $passErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["pass"])) {
        $passErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["pass"])) {
        $passErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }





      }


      if (empty($_POST["Cpass"])) 
    {
    $CpassErr = "Please re-enter password";
    } 
    
    else 
    {
    $Cpass = test_input($_POST["Cpass"]);
       

      if (strlen($_POST["Cpass"]) < 8)

      {
        $CpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["Cpass"])) {
        $CpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["Cpass"])) {
        $CpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["Cpass"])) {
        $CpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["Cpass"])) 
    {
        $CpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }

        

          elseif( $pass !=$Cpass)
          {
            $CpassErr="Re-type password must be matched with password";
          }
       }




      if (empty($_POST["un"])) 
    {
    $unErr = "Enter user name";
    }

    else 
    {
    $un = test_input($_POST["un"]);


         if ( (str_word_count($username_count) < 2)) 
         {
                $unErr = "At least two characters and Alphabets only";
            }


          elseif (!preg_match('/^[A-Za-z0-9\s.-._]+$/', $un))
          {
            $unErr= "User Name must contain alpha numeric characters, period, dash or underscore only!";
          }

       }
       if (empty($_POST["dob"])) 
    {
    $dobErr = "dob is required";
    } 
    else 
    {
    $dob = test_input($_POST["dob"]);
     }
   
   
           
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
                } else {
                    $ImgErr = "Sorry, there was an error uploading your file.";
                }
            }
        }
        else{
            $ImgErr="Select an image!";
        }

    

       $insertion = "";
   if($nameErr =="" && $emailErr==""&&$unErr==""&&$genderErr==""&&$passErr==""&&$CpassErr==""&&$dobErr==""&&$ImgErr=="")
     {
        if (file_exists("information.json"))
             {
            $current_content = file_get_contents("information.json");
            $array_content = json_decode($current_content, true);
            $new_content = array(
                'Name' => $_POST["name"],
                'Email' => $_POST["email"],
                'Username' => $_POST["un"],
                'Password' => $_POST["pass"],
                'Gender' => $_POST["gender"],
                'DOB' => $dob,
                'Image' => $filepath
                );
            $array_content[] = $new_content;
            $final_content = json_encode($array_content, JSON_UNESCAPED_SLASHES);
            if (file_put_contents("information.json", $final_content)) {
                $insertion = "Registration done successfully!";
            }
        }
        else 
        {
            $insertion = "JSon File Does not Exist";
        }
    } 



 }

  function test_Input($data)
    {
        $information = trim($data);
        $information = stripslashes($data);
        $information = htmlspecialchars($data);
        return $data;
    }

?>           <br></br>
            <fieldset>
                    <legend style="color: brown;"><b>Registration Form</b></legend>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                
                    
                   
        
                <label ><b>Enter Your Name</b>&nbsp;</label>
                <input type="text" id="name" name="name"  placeholder="Your name" size="10" value="<?php echo $name;?>">
               
                    <?php 
                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    <hr>
                    <br></br>
                
                 <label><b>Enter your email</b>&nbsp; </label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="Your email">
                    <?php if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                    <hr>
                    <br></br>

                    <label><b>Enter User Name</b></label>
                     <input type="text" name = "un" value="<?php echo $un;?>"placeholder="Your username">
                         <?php if ($unErr != "") 
                        {
                        echo "*";
                        echo $unErr;
                    }
                    ?>

                       <hr>

                     <br></br>

                    <label><b>Enter Password</b></label>
                     <input type="password" name = "pass" value="<?php echo $pass;?>" placeholder="Password" >
                     <?php if ($passErr != "") 
                        {
                        echo "*";
                        echo $passErr;
                    }
                    ?>
                    <hr>
                     <br><br /> 

                     <label><b>Re-enter Password</b></label>
                     <input type="password" name = "Cpass" value="<?php echo $Cpass;?>"placeholder="confirm Password">
                     <?php if ($CpassErr != "") 
                        {
                        echo "*";
                        echo $CpassErr;
                    }
                    ?>
                    <hr>



                     <br> <br /> 




                <label><b>Enter your gender</b>&nbsp;</label>
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">
                <label for="">Male</label> 

                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="female") echo "checked";?> value="female"> 
                <label for=" ">Female</label> 
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="other") echo "checked";?> value="other"> 
                <label for="">Other</label> 
                <?php 
               if($genderErr)
               {  
                echo "* ";
                echo $genderErr;

                    }
                ?>
                <hr>
                <br></br>


                    <label><b>Enter date of birth</b>&nbsp;</label>
                    <input type="date" name="dob" value="<?php echo $dob;?>">

                    <?php 
               if($dobErr)
               {  
                echo "* ";
                echo $dobErr;

                    }
                ?>
                <hr>

             <label><b>Enter profile picture</b>&nbsp;</label>
              <input type="file" name="fileToUpload" id="fileToUpload">
          <img src="<?php if(!empty($filepath)){echo $filepath;}else{ echo "pictures/default.jpg";} ?>" alt="" width="200px" height="200px"><br></br>
                 <?php
                    if ($ImgErr) {
                        echo ($ImgErr);
                    }
                    ?>

                    


                      <input type="submit" value="Submit">


                    </fieldset>
            
        
          
            <?php
            if (isset($insertion)) 
            {
                echo "<span style='color:brown'><b>" . $insertion . "</b></span><br>";
            }
            ?>

                </form>
                
                <div>

                <?php
                  include "Footer.php";
                ?>
              </div>


</body>
</html>