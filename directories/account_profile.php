<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/product_actions.css">
    <link rel="stylesheet" href="../styles/loader.css">

    <!-- <script async type="module" src="../scripts/pipe.js"></script> -->
    <script async type="module" src="../scripts/account_profile.js"></script>

    <title>Account profile</title>
    
</head>

<body>
    
    <div class="nav_panel">

        <div class="left_float">
            <img src="../assets/images/Group 145 copy.svg" alt="c_avatar" class="avatar">
        </div>
        
        <div class="right_float">
            <li class="profile_tabs verify_agent">
                <a href="../directories/agent_verification.php" class="picking_dir"> Verify Agent </a> 
            </li>

            <li class="profile_tabs picking_product">
                <a href="../directories/product_pick_up.php" class="picking_dir"> Picking product </a>
            </li>

            <li class="profile_tabs fraud_awareness">
                <a href="../directories/fraud_awareness.php" class="picking_dir"> Fraud awareness </a>
            </li>

            <li class="profile_tabs dashboard">
                <a href="../directories/dashboard.php" class="picking_dir"> Dashboard </a>
            </li>


            <li class="profile_tabs profile_username username"> Username </li>
            <img src="../assets/images/e0e69226-9ff0-4e4e-a0fe-5ad8555a07e8.jpg" alt="u_avatar" class="avatar u_avatar">
        </div>
        
    </div>

    <div class="product_activities_hero">

        <div class="product_activity_title">
            Account profile
        </div>

        <img src="../assets/images/033-user.svg" alt="action_image" class="product_activity_image">
            
    </div>

    <form enctype="multipart/form-data" action="" method="post" class="product_delivery_registration user_profile_account">

        <label for="p_name">Full name</label>
        <input type="text" placeholder="Please enter full name" class="product_name user_fullname" name="user_fullname">
        <!-- <label for="p_name_notifier" class="p_name_error_notifier notifier">Please enter your first name</label> -->

        <label for="user_email"> Email </label>
        <input type="text" placeholder="Please enter email" class="u_email" name="user_email">
        <!-- <label for="u_email_notifier" class="u_email_error_notifier notifier"> Please enter email </label> -->

        <label for="user_PIN"> Private PIN </label>
        <input type="text" placeholder="Please your private pin" class="user_PIN" name="user_PIN">
        <!-- <label for="user_PIN_notifier" class="user_PIN_error_notifier notifier"> Please private PIN </label> -->
        
        <div class="PIN_details" style="background-color:whitesmoke;color:gray; padding: 1rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; width: 50%; margin-bottom: 2rem;">
            This PIN( Personal Identification Number) is to avoid account hijacking, manipulations and blocking.
        </div>

        <label for="p_image_upload"> Upload your profile image </label>
        <label for="upload" class="p_img_upload_lb"> Select image </label> 
        
        <input type="file" name="user_avatar_upload_btn" class="image_selector product_upload_button">
        

        <img src="../assets/images/033-user.svg" height="200px" alt="user-avatar" style="margin-bottom: 2rem;" class="p_image_placeholder user_image_placeholder">
        <div class="form_loader"></div>

        <!-- <label for="image_upload_notifier" class="p_image_upload_notifier notifier"> Please select image to upload </label> -->

        <button name="" class="product_delivery_submit_btn account_submit_btn"> Submit </button>

        <label for="user_PIN_notifier" class="notifier form_notifier" style ="text-align:center; font-size:1rem;">  </label>

        <div class="form_loader"></div>

    </form>

</body>
</html>