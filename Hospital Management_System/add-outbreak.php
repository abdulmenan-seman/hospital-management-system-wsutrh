// filepath: c:\xampp\htdocs\Hospital_Management_System\signup-doctor.php
<?php 
require_once "importance.php"; 

if(!User::loggedIn()){
    Config::redir("login.php"); 
}
?> 

<html>
<head>
    <title>Signup Doctor - <?php echo CONFIG::SYSTEM_NAME; ?></title>
    <?php require_once "inc/head.inc.php";  ?> 
</head>
<body>
    <?php require_once "inc/header.inc.php"; ?> 
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-2'><?php require_once "inc/sidebar.inc.php"; ?></div> 
            <div class='col-md-7'>
                <div class='content-area'> 
                    <div class='content-header'> 
                        Signup Doctor <small>Add a new doctor to the system</small>
                    </div>
                    <?php require_once "inc/alerts.inc.php";  ?> 
                    <div class='content-body'> 
                        <div class='form-holder'>
                            <?php 
                            if(isset($_POST['fn'])){
                                $firstName = $_POST['fn'];
                                $secondName = $_POST['sn'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $role = $_POST['role'];
                                $gender = $_POST['gender'];
                                $password = $_POST['password'];

                                // Call the function to register the doctor
                                Doctor::register($firstName, $secondName, $email, $phone, $role, $gender, $password);
                                Config::redir("doctors-record.php?message=Doctor has been added successfully!");
                            }

                            $form = new Form(3, "post");
                            $form->init(); 
                            $form->textBox("First Name", "fn", "text", "", "");
                            $form->textBox("Second Name", "sn", "text", "", "");
                            $form->textBox("Email", "email", "email", "", "");
                            $form->textBox("Phone", "phone", "text", "", "");
                            $form->textBox("Role", "role", "text", "", "");
                            $form->select("Gender", "gender", ["Male", "Female", "Other"]);
                            $form->textBox("Password", "password", "password", "", "");
                            $form->close("Signup Doctor");
                            ?> 
                        </div> 
                    </div><!-- end of the content area --> 
                </div> 
            </div><!-- col-md-7 --> 

            <div class='col-md-3'>
                <img src='images/doc-background-one.png' class='img-responsive' /> 
            </div> 
        </div> 
    </div> 
</body>
</html>