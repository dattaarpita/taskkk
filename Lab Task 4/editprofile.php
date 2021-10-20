<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="Dashboard.css">
</head>
<body>
	<?php
	session_start();
	$isset=false;

    if(isset($_SESSION['un']))
    {
        $current = file_get_contents("information.json");  
        $current = json_decode($current, true); 
        foreach($current as $key=>$value){
            if($value['Username']==$_SESSION["un"])
            {
            $Name=$value['Name'];
            $Gender=$value['Gender'];
            $Image=$value['Image'];
             
            $DOB=$value['DOB'];
            $Email=$value['Email'];
            $isset=true;
            break;
            }
        }
        if($isset){
             $Confirm_msg="";
        }else{
             $Errmsg="Something did not match";
        }


    }
    $nameErr =$emailErr=$genderErr=$dobErr="";
    $name = $email =$gender=$dob="";
    $Username=$_SESSION["un"];

     if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
         $name_count = $_POST["name"];
        $Name = $_POST['name'];
         $Email= $_POST['email'];
         $DOB= $_POST['dob'];
         $Gender =$_POST['gender'];

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
     if (empty($_POST["dob"])) 
    {
    $dobErr = "dob is required";
    } 
    else 
    {
    $dob = test_input($_POST["dob"]);
     }

  if(empty($nameErr) && empty($emailErr)&& empty($genderErr)&&empty($genderErr)&&empty($dobErr)&&$_SERVER["REQUEST_METHOD"] == "POST")
       {
        $message="";

        $data = file_get_contents("information.json");
         $data = json_decode($data, true);
        if (!empty($data))
         {
            foreach ($data as $key => $row)
             {

             if ($row["Username"] == $_SESSION["un"]) 

             {

                $data[$key]['Name'] = $name;

                $data[$key]['Email'] = $email;
                $data[$key]['Gender'] = $gender;
                $data[$key]['DOB'] = $dob;


                file_put_contents('information.json', json_encode($data));
                $_SESSION["name"] = $name;
                $_SESSION["pass"] = $email;
                $_SESSION["gender"] = $gender;
                $_SESSION["dob"] = $dob;

            $message = "Profile updated!";
            
                    break;
             }
    }

    }
       }




    
}


function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<?php

    include 'Head.php';

    ?>
    <br></br>

    <div class="intro">
        
        <br>
    <?php  
    
    
    echo "Logged in as , ".$Name;

    ?>

    
    <br>
    <a href="Login.php" target="_self" >Log out</a>
    <img class="intro2" src="<?php echo $Image ?>" width="120px" height="120px"><br><br>

    </div>
    <table border=1 style="width:850px; border-style: none;border-collapse: collapse;">
        
    <tr>
            
        <td  style="width:250px">
            <legend> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Account<hr></legend>
            <ul >
                <li><a href="Dashboard.php">Dashboard</a></li>
                <li><a href="viewprofile.php">View Profile</a></li>
                <li><a href="editprofile.php">Edit Profile</a></li>
                <li><a href="Profile Picture.php">Change Profile Picture</a></li>
                <li><a href="Change Password.php">Change Password</a></li>
                <li><a href="Login.php">Log out</a></li>
            </ul>
        </td>
        <td>
        	<fieldset>

            <legend style="color: brown;"><b>Edit Profile</b></legend>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
          	<label ><b> Name</b>&nbsp;</label>
                <input type="text" id="name" name="name"  placeholder="Your name" size="10" value="<?php echo $name;?>">
               
                    <?php 
                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    <hr>
                    <br>
                
                 <label><b>Email</b>&nbsp; </label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="Your email">
                    <?php if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                    <hr>
                    <br>
                     <label><b>Gender</b>&nbsp;</label>
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
                <br>


                    <label><b>DOB</b>&nbsp;</label>
                    <input type="date" name="dob" value="<?php echo $dob;?>">

                    <?php 
               if($dobErr)
               {  
                echo "* ";
                echo $dobErr;

                    }
                ?>
                <hr>



            <input type="submit" value="Submit">
        </fieldset>
        <?php
            if (isset($message)) 
            {
                echo "<span style='color:brown'><b>" . $message . "</b></span><br>";
            }
            ?>
         
    </td>
</tr>
</table>
<?php
                      include "Footer.php";
                    ?>

</body>
</html>