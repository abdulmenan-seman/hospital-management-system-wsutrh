<?php 
require_once "importance.php"; 

if(User::loggedIn()){
    Config::redir("index.php"); 
}
?> 

<html>
<head>
    <title>LOGIN - <?php echo CONFIG::SYSTEM_NAME; ?> </title>
    <?php require_once "inc/head.inc.php";  ?> 
    <style>
    <?php $imagePath = 'images/klIfiB5vf4GbTP7BmdT7YRkB3UQFVEQyYLXJT3oM.jpg'; ?>
    .content-body {
        background-image: url('<?php echo $imagePath; ?>');
        background-size: cover; /* Use 'cover' instead of fixed size */
        background-position: center; /* Center the image */

    }
    <style>
    <?php $imagePath = 'images/yIdQincAtPg9Qj9V0Lj4YbLgkVFDXjTzGQIWYTVb.jpg'; ?>
    .body {
        background-image: url('<?php echo $imagePath; ?>');
        background-size: cover; /* Use 'cover' instead of fixed size */
        background-position: center; /* Center the image */
    }
    img[src='images/20240507_154033.jpg']{
        height: 200px
        width: 200px
        border-radius:50%
    }
</style>


</head>
<body class='body'>
    <?php require_once "inc/header.inc.php"; ?> 
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-3'  style="background-image: url('images/OIP (1).jfif'); background-size: cover; background-position: center;"> 
            
                <img src='images/yIdQincAtPg9Qj9V0Lj4YbLgkVFDXjTzGQIWYTVb.jpg' class='img-responsive' style="height: 200px; width: 200px; border-radius: 50%"/> 
                <h1 style="color: red">WELCOME TO... </h1>
                <h2 style="color: blue">Wolaita Sodo University Teaching and Referral Hospital<h2/>
            </div> <!-- this should be a sidebar --> 
            <div class='col-md-9'>
                <div class='content-area'> 
                    <div class='content-header'> 
                        Login <small>Login to access the system</small>
                    </div>
                    <div class='content-body' style="height: 400px; width: 100%; background-size: cover; background-position: center;" > 
          
                        <?php 
                        if(isset($_GET['attempt'])){
                            // STARTING THE LOGIN AREA 

                            $status = $_GET['attempt'];

                            if($status == 1){
                                $header = "Login as an Admin"; 
                            } else {
                                $header = "Login as a Doctor"; 
                            }

                            echo "<center><div class='badge-header'>$header</div></center>"; 

                            // we created a method for creating forms

                            if(isset($_POST['login-email'])){
                                $email = $_POST['login-email']; 
                                $password = $_POST['login-password'];

                                if($email == "" || $password == ""){
                                    Messages::error("You must fill in all the fields");
                                } else {
                                    User::login($email, $password, $status);
                                }

                            }

                        ?> 
                        <div class='row'>
                            <div class='col-md-3'></div>
                            <div class='col-md-6'>
                                <div class='form-holder'>
                                    <?php Db::form(array("Email", "Password"), 3, array("login-email", "login-password"), array("text", "password"), "Login"); ?> 
                                </div>
                            </div> 
                            <div class='col-md-3'></div>
                        </div> 
                        <?php 
                            // ENDING THE LOGIN AREA
                        } else {

                        ?>

                        <center><div class='badge-header'>Login As:</div></center> 
                        <div class='row'>
                            <div class='col-md-2'>
                            <div class='img-login-icons'>
                                                <img  class='img-responsive' src='images/3678411 - hospital medical nurse.png' alt='login as a doctor' />
                                            </div>
                                            <center><a href='login.php?attempt=1'><div class='badge-header'>Admin</div></a></center> 

                                        </center> 
                                    </div> 
                                    <div class='col-md-4'> 

                                        <center>
                                            <div class='img-login-icons'>
                                                <img  class='img-responsive' src='images/3678412 - doctor medical care medical help stethoscope.png' alt='login as a doctor' />
                                            </div>
                                            <center><a href='login.php?attempt=2'><div class='badge-header'>Doctor</div></a></center> 
                                        </center>
                                    </div> 
                                    
                                    <div class='col-md-4'> 

                                        <center>
                                            <div class='img-login-icons'>
                                                <img  class='img-responsive' src='images/3678443 - ambulance fast fast hospital.png' alt='login as a doctor' />
                                            </div>
                                            <center><a href='login-patient.php'><div class='badge-header'>Patient</div></a></center> 
                                        </center>
                                    </div> 
                                    
                            </div>
                             
                            <div class='col-md-2'></div>
                            <?php } ?> 
                        </div><!-- end of the content area --> 
                    </div> 
                </div>  
            </div> 
        </div> 
    </div> 
</body>
</html>
