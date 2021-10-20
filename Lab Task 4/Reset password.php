<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
    <?php

include 'Head.php';

?>
	<?php
	$email="";
	$emailErr=$Confirm_msg=$Errmsg="";
	 if (($_SERVER["REQUEST_METHOD"] == "POST"))
	 	
	 {
	 	$Email= $_POST['email'];
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

    $isset=false;

    if($emailErr==""){
        $c_content = file_get_contents("information.json");  
        $c_content= json_decode($c_content, true); 
        foreach($c_content as $key=>$value){
            if($value['Email']==$Email){
            $isset=true;
            break;
            }
        }
        if($isset){
             $Confirm_msg="A verification code sent to your email";
        }
        else{
             $Errmsg="Email address did not match";
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
        <br></br>
	 <fieldset>

	 	 <legend style="color: brown;"><b>Forgot Password</b></legend>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              	 <label><b>Enter  email</b>&nbsp; </label>
                <input type="text" id="email" name="email" >
                 <?php
                     if($emailErr!="")
                     {
                        echo "*";
                        echo  $emailErr;
                     }
                     else if($Errmsg!=""){
                         echo "*";
                         echo $Errmsg;
                     }
                     ?>

                <hr>
                 <input type="submit" value="Submit"name="submit"class="button1">
                 <br>
                  <?php
                 if($Confirm_msg!=""){
                     echo $Confirm_msg;
                 }
                 ?>
                 
                 </fieldset>
	               </form>
	           <br>
	            <?php
                  include "Footer.php";
                ?>

</body>
</html>