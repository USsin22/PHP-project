
<?php 
include 'conn.php';
session_start();
$errorM = [
    'email' => '',
    'pass' => '',
    'general' => '',
    'nom' => '',
    'prenom' => ''
];
$nom = '';
$prenom = '';
$email = '';
$pass = '';
$alert = '';
$isEmailRepeat = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (isset($_POST['login'])) {
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prnom']);
        $email = trim($_POST['email']);
        $pass = $_POST['password'];

        if (empty($nom)) {
            $errorM['name'] = 'LastName Required';
        }
        if (empty($prenom)) {
            $errorM['lastname'] = 'Name Required';
        }
        if (empty($email)) {
            $errorM['email'] = 'Email Required';
        }
        if (empty($pass)) {
            $errorM['password'] = 'Password Required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorM['email'] = 'Email Is not valid!!';
        } else {
            foreach ($users as $user) {
                if ($user['email'] == $email) {
                    $isEmailRepeat = true;
                    $errorMe['general'] = "This Email alerdy used";
                    $message = $errorMe['general'];
                    $alert = "<div class='alert alert-danger alert-dismissible fade show mx-auto mt-3' style='width:500px; font-weight:bold;' role='alert'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                $message 
            </div>";
                }
            }
            if (!$isEmailRepeat) {
                $passHash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(name, lastnaem, email, pwdd) VALUES('$nom', '$prenom', '$email','$passHash')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header('Location: index.php');
                    $nom = '';
                    $prenom = '';
                    $email = '';
                    $pass = '';
                    exit();
                } else {
                    $errorMe['general'] = "There is an Error";
                    $message = $errorMe['general'];
                    $alert = "<div class='alert alert-danger alert-dismissible fade show mx-auto mt-3' style='width:500px; font-weight:bold;' role='alert'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                $message 
            </div>";
                }
            }
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        if (empty($email)) {
            $errorM['email'] = 'Email Required';
        }
        if (empty($pass)) {
            $errorM['password'] = 'Password Required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorM['email'] = 'Email Is not valid!!';
        } else {
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
            if ($user && password_verify($pass, $user['pass'])) {
                $_SESSION['id'] = $user['id'];
                $userId= $_SESSION['id'];
                $_SESSION['name'] = $user['name'];
            
                header("Location: home.php?id_user=$userId");
                exit();
            } else {
                $errorMe['general'] = "Invalid email or password";
                $message=$errorMe['general'];
                $alert="<div class='alert alert-danger alert-dismissible fade show mx-auto mt-3' style='width:500px; font-weight:bold;' role='alert'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                $message 
            </div>";
            }
        }
    }
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
</head>
<body>
    


<div class="container" id="container">
        <!-- Registration Form -->
        <div class="form-container sign-up-container">
            <form method="POST" >
                <h1>Create Account</h1>
                <input type="text" name="name" placeholder="Name"   required />
                <input type="text" name="lastname" placeholder="Last Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="password" required />
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>

        <!-- Login Form -->
        <div class="form-container sign-in-container">
            <form method="POST">
                <h1>Sign In</h1>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="#">Forgot your password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>

        <!-- Overlay Panels -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start your journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
        <?php  if (!empty($msg)) {
          echo $msg;
        }?>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>
    
</body>
</html>