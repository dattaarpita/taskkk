
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
            $Image=$value['Image']; 
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

    }

    ?>
<?php

include 'Head.php';

?>

<br></br>


<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet"  href="Dashboard.css">
</head>
<body>
    
      <br>
	<div class="intro">
        
        <br>
    <?php  
    
    
    echo "Logged in as , ".$Name;

    ?>

    
    <br>
    <a href="Login.php" target="_self" >Log out</a>
    <img class="intro2" src="<?php echo $Image ?>" width="120px" height="120px"><br><br>

    </div>

    

  <div>
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
            <?php
                echo " <b>   Welcome , ".$Name."<b>";
            ?>
           </td>
        
        </tr>
    </table> 
   </div>

   <?php
    include "Footer.php";
    ?>

</body>
</html>