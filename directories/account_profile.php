<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/product_actions.css">
    <script async type="modules" src="../scripts/pipe.js"></script>

    <title>Account profile</title>
    
</head>

<body>
    
    <div class="nav_panel">
        <div class="left_float">
            <img src="../assets/images/Group 145 copy.svg" alt="c_avatar" class="avatar">
        </div>
        
        <div class="right_float">
            <li class="profile_tabs verify_agent">
                <a href="../directories/agent_verification.html" class="picking_dir"> Verify Agent </a> 
            </li>

            <li class="profile_tabs picking_product">
                <a href="../directories/product_pick_up.html" class="picking_dir"> Picking product </a>
            </li>

            <li class="profile_tabs fraud_awareness">
                <a href="../directories/fraud_awareness.html" class="picking_dir"> Fraud awareness </a>
            </li>

            <li class="profile_tabs dashboard">
                <a href="../directories/dashboard.html" class="picking_dir"> Dashboard </a>
            </li>


            <li class="profile_tabs username">Username</li>
            <img src="../assets/images/e0e69226-9ff0-4e4e-a0fe-5ad8555a07e8.jpg" alt="u_avatar" class="avatar u_avatar">
        </div>
        
    </div>

    <div class="product_activities_hero">

        <div class="product_activity_title">
            Account profile
        </div>
        <img src="../assets/images/033-user.svg" alt="action_image" class="product_activity_image">
            
    </div>

    <form action="" method="post" class="product_delivery_registration">

        <label for="p_name">First name</label>
        <input type="text" placeholder="Please enter first name" class="product_name" >
        <label for="p_name_notifier" class="p_name_error_notifier notifier">Please enter your first name</label>

        <label for="P_category"> Last name </label>
        <input type="text" placeholder="Please enter your last name" class="product_category">
        <label for="p_category_notifier" class="p_category_error_notifier notifier"> Please enter your last name </label>

        <label for="receiver_email"> Email </label>
        <input type="text" placeholder="Please enter email" class="r_email">
        <label for="r_email_notifier" class="r_email_error_notifier notifier"> Please enter email </label>

        <label for="receiver_email"> Private PIN </label>
        <input type="text" placeholder="Please your private pin" class="r_email">
        <label for="r_email_notifier" class="r_email_error_notifier notifier"> Please private PIN </label>
        <div class="PIN_details" style="background-color:whitesmoke;color:gray; padding: 1rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; width: 50%; margin-bottom: 2rem;">
            This PIN(personal identification number) is to avoid account hijacking, manipulations and blocking.
        </div>

        <label for="p_image_upload"> Upload your profile image </label>
        <label for="upload" class="p_img_upload_lb"> Select image </label> 
        <input type="file" placeholder="Select image" class="product_upload_button"> 
        

        <img src="../assets/images/033-user.svg" height="200px" alt="" class="p_image_placeholder">

        <label for="image_upload_notifier" class="p_image_upload_notifier notifier"> Please select image to upload </label>

        <button name="" class="product_delivery_submit_btn"> Submit </button>

    </form>

</body>
</html>