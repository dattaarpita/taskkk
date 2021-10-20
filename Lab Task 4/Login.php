<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log-in Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
    <?php

include 'Head.php';

?>
	<?php
    session_start();
      $un=$pass="";
      $Username="";
      $Confirmation="";
      $unErr=$passErr="";
      if (($_SERVER["REQUEST_METHOD"] == "POST"))
          {
         
         
         if(isset($_POST["remember"]))
          { 
            $username_count=$_POST["un"];

             

        setcookie('u_name',$_POST['un'],time()+25);
        setcookie('c_pass',$_POST['password'],time()+25);
        $_SESSION['un']=$_POST["un"];
        $_SESSION['pass']=$_POST["password"];
        $user=$_SESSION['un'];
        $passwrd=$_SESSION['pass'];


              
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

     if (empty($_POST["password"])) 
    {
    $passErr = "Password is required";
    } 
    else 
    {
    $pass = test_input($_POST["password"]);

      if (strlen($_POST["password"]) < 8) {
        $passErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
        $passErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
        $passErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
        $passErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
        $passErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }





      }

         $isset=false;
    
        if($unErr=="" && $passErr=="")
        {
            $data_s = file_get_contents("information.json");  
            $data_s = json_decode($data_s, true); 
                foreach($data_s as $row)
                {
                    if($row["Username"]==$user && $row["Password"]==$passwrd){
                    $isset=true;
                    break;
                    }
                }
            
            

    
            if($isset)
            {
                 $ConfirmMessage="";
                 header("location:Dashboard.php");
            }
        

           else
           {
                 

                 echo '<span style="font-size: 20px; color:green; font-weight: bold;">Something did not match.Please try again!</span> ';
                 

            }

        }
    }


    else
    {
        $username_count=$_POST["un"];


        $_SESSION['un']=$_POST["un"];
        $_SESSION['pass']=$_POST["password"];
        $user=$_SESSION['un'];
        $passwrd=$_SESSION['pass'];


              
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

     if (empty($_POST["password"])) 
    {
    $passErr = "Password is required";
    } 
    else 
    {
    $pass = test_input($_POST["password"]);

      if (strlen($_POST["password"]) < 8) {
        $passErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
        $passErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
        $passErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
        $passErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
        $passErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }





      }
          $isset=false;
    
        if($unErr=="" && $passErr=="")
        {
            $data_s = file_get_contents("information.json");  
            $data_s = json_decode($data_s, true); 
                foreach($data_s as $row)
                {
                    if($row["Username"]==$user && $row["Password"]==$passwrd)
                    {
                        
                        $_SESSION['Name'] = $row["Name"];
                        $_SESSION['Email'] = $row["Email"];
                        $_SESSION['DOB'] = $row["DOB"];
                        $_SESSION['Gender'] = $row["gender"];
                        $_SESSION['Image'] = $row["Image"];
                    $isset=true;
                    break;
                    }
                }
            
            

    
            if($isset)
            {
                 $ConfirmMessage="";
                 header("location:Dashboard.php");
            }
        

           else
           {
                 

                 echo '<span style="font-size: 20px; color:green; font-weight: bold;">Something did not match.Please try again!</span> ';
                 

            }

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

    ?>
                   <br></br>

                 <fieldset>
                    <legend style="color: brown;"><b>Login Form</b></legend>
                      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         


                          <label><b>User Name</b></label>
                     <input type="text" name = "un" placeholder="Username"  
                     value="<?php if(isset($_COOKIE['user'])) {echo $_COOKIE['cpass']; } ?>">


                         <?php if ($unErr != "") 
                        {
                        echo "*";
                        echo $unErr;
                    }
                    ?>
                          <br></br>

                     

                     <label><b>Enter Password</b></label>
                     <input type="password" name = "password"  id="pass"  
                      value="<?php if(isset($_COOKIE['cpass'])) {echo $_COOKIE['cpass'];} ?>" >
                     <?php if ($passErr != "") 
                        {
                        echo "*";
                        echo $passErr;
                    }
                    ?>
                    <br>

                    <script>
            function myFunction() 
            {
            var y = document.getElementById("pass");
            if (y.type === "password")
             {
            y.type = "text";
            } 
            else 
            {
            y.type = "password";
            }

            }

           </script>
                    <input type="checkbox" onclick="myFunction()">
                    <label> Show Password</label>  
                    <hr>

                    <input type="checkbox" id="remember" name="remember"> 
                   
                    <label>Remember me</label>
                    <br></br>

                      <input type="submit" value="Submit">
                 <a href="Reset password.php">Forgot password?</a>
                 <br>
                 <p>Not a member yet? <a href="Registration.php">Sign-up</a></p>

                     
                     </fieldset>
                     
                     

                </form>

                 <?php
                  include "Footer.php";
                ?>




	

</body>
</html>