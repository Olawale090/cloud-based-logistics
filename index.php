<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="./styles/form.css">
    <script async type="module" src="./scripts/user_auth.js"></script>
    <title>Sign in</title>
</head>
<body>
    <div class="nav_panel">
        <img src="./assets/images/Group 145 signin.svg" alt="comp_avatar" class="comp_avatar">
    </div>
    <div class="form_title"> Login </div>
    <form class="signin_form" action="" method="get">
        
        <label for="Email">E-mail</label>
        <input type="email" name="user_signin_email" placeholder = "Email here" id="" class="signin_email">
        
        <label for="Email">Password</label>
        <input type="password" name="user_signin_password" placeholder = "Password here" id="" class="signin_password">

        <input type="button" name="user_signin_submit_btn" value="Submit" id="" class="sign_btn signin_btn" >

        <div class="sign_dir"> Don't have an account? 
        
            <a href="./directories/signup.php" class="sign_up_redirect"> Sign up </a>

        </div>

        <div class="form_auth_message signin_auth_message"> </div>

    </form>
</body>
</html>