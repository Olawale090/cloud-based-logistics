<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="../styles/loader.css">

    <script async type="module" src="../scripts/signup.js"></script>
    

    <title>Sign up</title>

</head>
<body>

    <div class="nav_panel">
        <img src="../assets/images/Group 145 signin.svg" alt="comp_avatar" class="comp_avatar">
    </div>

    <div class="form_title"> Sign up </div>

    <form class="signin_form" action="" method="get">

        <label for="Fullname">Full name</label>
        <input type="text" name="user_fullname" placeholder = "Full name here" id="new_user_fullname" class="signup_fullname">
        
        <label for="Email">E-mail</label>
        <input type="text" name="user_email" placeholder = "Email here" id="new_user_email" class="signup_email">
        
        <label for="Password">Password</label>
        <input type="password" name="user_password" placeholder = "Password here" id="new_user_password" class="signup_password">

        <label for="Confirm_Password"> Confirm password</label>
        <input type="password" name="user_confirm_password" placeholder= "Confirm password here" id="new_user_confirm_password" class="signup_confirm_password">


        <input type="button" name="submit_btn" value = "Submit" id="new_user_submit_btn" class="sign_btn signup_submit_button">

        <div class="sign_dir"> Already have an account? 
        
            <a href="../index.php" class="sign_up_redirect"> Sign in </a>

        </div>

        <div class="form_auth_message signup_auth_message">
            <!-- Please enter valid email or Password -->
        </div>

        <div class="form_loader"></div>

    </form>
</body>
</html>