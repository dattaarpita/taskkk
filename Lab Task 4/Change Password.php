    <!DOCTYPE html>
    <html>
    <head>
    	<meta charset="utf-8">
    	<title>Change Password</title>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="Dashboard.css">
    </head>
    <body>
    	<?php
         session_start();
        $isset=false;
        $currpass=$newpass=$rnewpass=$message="";
        $currpassErr=$newpassErr=$rnewpassErr="";


        if(isset($_SESSION['un']))
        {
            $currentdata = file_get_contents("information.json");  
            $currentdata = json_decode($currentdata, true); 
            foreach($currentdata as $key=>$value){
                if($value['Username']==$_SESSION["un"])
                {
                $Name=$value['Name'];
                $Gender=$value['Gender'];
                $Username=$value['Username']; 
                $DOB=$value['DOB'];
                $Image=$value['Image']; 
                
                $isset=true;
                break;
                }
            }
        }
            if($isset){
                 $Confirm_msg="";
            }else{
                 $Errmsg="Something did not match";
            }


    	

    	 if (($_SERVER["REQUEST_METHOD"] == "POST"))
        {
           
            
              if (empty($_POST["currpass"])) 
        {
        $currpassErr = "Password is required";
        } 
        else 
        {
        $currpass = test_input($_POST["currpass"]);

          if (strlen($_POST["currpass"]) < 8) {
            $currpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
        }
        elseif(!preg_match("#[0-9]+#",$_POST["currpass"])) {
            $currpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
        }
        elseif(!preg_match("#[A-Z]+#",$_POST["currpass"])) {
            $currpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
        }
        elseif(!preg_match("#[a-z]+#",$_POST["currpass"])) {
            $currpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
        }
        elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["currpass"])) {
            $currpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
        }

            }

         
         
        if (empty($_POST["newpass"])) 
        
        {
        $newpassErr = " New password is required";
        } 


        else
        {
        $newpass = test_input($_POST["newpass"]);

           if($currpass!=$newpass)
           {

          if (strlen($_POST["newpass"]) < 8) 
          {
            $newpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
        }
        elseif(!preg_match("#[0-9]+#",$_POST["newpass"])) {
            $newpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
        }
        elseif(!preg_match("#[A-Z]+#",$_POST["newpass"])) {
            $newpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
        }
        elseif(!preg_match("#[a-z]+#",$_POST["newpass"])) {
            $newpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
        }
        elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["newpass"])) 
        {
            $newpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
        }

            }
            else 
            {
                $newpassErr="New Password should not be same as the Current Password";

            }
        }


        
          if (empty($_POST["rnewpass"])) 
        {
        $rnewpassErr = "Please re-type new password";
        } 
        else 
        {
        $rnewpass = test_input($_POST["rnewpass"]);
           

          if (strlen($_POST["rnewpass"]) < 8)

          {
            $rnewpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
        }
        elseif(!preg_match("#[0-9]+#",$_POST["rnewpass"])) {
            $rnewpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
        }
        elseif(!preg_match("#[A-Z]+#",$_POST["rnewpass"])) {
            $rnewpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
        }
        elseif(!preg_match("#[a-z]+#",$_POST["rnewpass"])) {
            $rnewpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
        }
        elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["rnewpass"])) 
        {
            $rnewpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
        }

            

              elseif( $newpass !=$rnewpass)
              {
                $rnewpassErr="Current password must be matched with new password";
              }
              

           }
            

       }
       if(empty($currpassErr) && empty($newpassErr)&& empty($rnewpassErr)&& $_SERVER["REQUEST_METHOD"] == "POST")
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

                $data[$key]['Password'] = $newpass;

                file_put_contents('information.json', json_encode($data));
                $_SESSION["pass"] = $newpass;

            $message = "Password changed!";
            
                    break;
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
    <table border=1 style="width:800px; border-style: none;border-collapse: collapse;">
        
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

                        <legend style="color: brown;"><b>Change Password</b></legend>
                          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                             
                         <label><b>Enter Current Password:</b></label>
                        
              <input type="password" name="currpass" autocomplete="current-password" required="" 
              id="id_password"value="<?php echo $currpass;?>">
                         <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                         <?php if ($currpassErr != "") 
                            {
                            echo "*";
                            echo $currpassErr;
                        }
                        ?>
                        <script > const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#id_password');
      
     
      togglePassword.addEventListener('click', function (e) {
        
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        this.classList.toggle('fa-eye-slash');
    });
    </script>
                        
                        <br></br>


                         <label><b style="color: green;">Enter New Password:</b></label>
                                  
              <input type="password" name="newpass" autocomplete="current-password" required="" 
              id="n_password"value="<?php echo $newpass;?>">
                         
                         <?php if ($newpassErr != "") 
                            {
                            echo "*";
                            echo $newpassErr;
                        }
                        ?>
                        
                        <br></br>
                        
                            <label><b style="color: red;">Retype New Password:</b></label>
                    <input type="password" name="rnewpass" autocomplete="retype-password" required="" id="r_password"value="<?php echo $rnewpass;?>">
                    <?php if ($rnewpassErr != "") 
                            {
                            echo "*";
                            echo $rnewpassErr;
                        }
                        ?>

                           <hr>
                           <br>
                                 <input type="submit" value="Submit">

                           </fieldset>
                           <?php
            if (isset($message)) 
            {
                echo "<span style='color:brown'><b>" . $message . "</b></span><br>";
            }
            ?>

                               
           </form>
       </td>
   </tr>
</table>
                      
        <div>

                    <?php
                      include "Footer.php";
                    ?>
                  </div>

    </body>
    </html>
    

   