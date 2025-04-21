### Step 1: Create `signup-doctor.php`

Create a new file named `signup-doctor.php` in the `c:\xampp\htdocs\Hospital_Management_System\` directory.

```php
// filepath: c:\xampp\htdocs\Hospital_Management_System\signup-doctor.php
<?php 
require_once "importance.php"; 

if(User::loggedIn()){
    Config::redir("index.php"); 
}
?> 

<html>
<head>
    <title>Signup - <?php echo CONFIG::SYSTEM_NAME; ?></title>
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
                        Signup for Doctors <small>Create a new doctor account</small>
                    </div>
                    <div class='content-body'> 
                        <div class='form-holder'> 
                            <?php 
                            if(isset($_POST['fn'])){
                                $firstName = $_POST['fn'];
                                $secondName = $_POST['sn'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $password = $_POST['password'];
                                $role = $_POST['role'];
                                $gender = $_POST['gender'];

                                // Call a function to register the doctor
                                if(Doctor::register($firstName, $secondName, $email, $phone, $password, $role, $gender)){
                                    Messages::success("Doctor registered successfully!");
                                    Config::redir("login.php");
                                } else {
                                    Messages::error("Registration failed. Please try again.");
                                }
                            }

                            $form = new Form(3, "post");
                            $form->init(); 
                            $form->textBox("First Name", "fn", "text", "", "");
                            $form->textBox("Second Name", "sn", "text", "", "");
                            $form->textBox("Email", "email", "email", "", "");
                            $form->textBox("Phone", "phone", "text", "", "");
                            $form->textBox("Password", "password", "password", "", "");
                            $form->select("Role", "role", ["Doctor", "Specialist"], "Doctor");
                            $form->select("Gender", "gender", ["Male", "Female", "Other"], "Male");
                            $form->close("Signup");
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
```

### Step 2: Update `importance.php`

In the `importance.php` file, ensure that the `Doctor` class has a method for registration. If it doesn't exist, you can add it to the `Doctor` class.

```php
// In classes/Doctor.class.php
class Doctor {
    // Other methods...

    public static function register($firstName, $secondName, $email, $phone, $password, $role, $gender) {
        // Logic to insert the doctor into the database
        // Example:
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO doctors (first_name, second_name, email, phone, password, role, gender) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = Db::prepare($query);
        return $stmt->execute([$firstName, $secondName, $email, $phone, $hashedPassword, $role, $gender]);
    }
}
```

### Step 3: Update Redirects

Ensure that after a successful signup, the user is redirected to the login page or another appropriate page. This is already handled in the signup page code above.

### Step 4: Update Patient Login Functionality

If you need to ensure that the patient login functionality is working correctly, verify that the `login.php` file is set up to handle patient logins. Here’s a brief overview of what the `login.php` file should include:

```php
// In login.php
if(isset($_POST['phone']) && isset($_POST['p-number'])){
    $phone = $_POST['phone'];
    $number = $_POST['p-number'];
    if(Patient::authorize($phone, $number)){
        // Redirect to patient data page
        Config::redir("patient-data.php");
    } else {
        Messages::error("Invalid credentials. Please try again.");
    }
}
```

### Conclusion

With these changes, you will have a new signup page for doctors, and the necessary updates to handle doctor registration. Ensure that you test the signup functionality thoroughly to confirm that doctors can register successfully and that the data is stored correctly in your database.