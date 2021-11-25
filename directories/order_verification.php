<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/product_actions.css">
    <link rel="stylesheet" href="../styles/order_verification.css">

    <title>Order verification</title>
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


            <li class="profile_tabs username"> Username </li>
            <img src="../assets/images/e0e69226-9ff0-4e4e-a0fe-5ad8555a07e8.jpg" alt="u_avatar" class="avatar u_avatar">
        </div>
        
    </div>

    <div class="product_activities_hero">

        <div class="product_activity_title">
            Order verification
        </div>
        <img src="../assets/images/005-call.svg" alt="action_image" class="product_activity_image">
            
    </div>

    <div class="scanned_product_data">

        <form action="" method="get" class="scanned_product_data_texts">

            <label for="p_name"> Product name</label>
            <div class="p_name_value"> Mobile phone accessories </div>
    
            <label for="P_category"> Product category </label>
            <div class="p_name_value"> Communication devices </div>

            <label for="P_category"> Product quantity </label>
            <div class="p_name_value"> 100 </div>

            <label for="p_delivery_number"> Product delivery number </label>
            <div class="p_name_value"> 8947884594 </div>
            
            <label for="p_receiver_phone"> Receiver's phone number </label>
            <div class="p_name_value"> 08168612448 </div>
            
            
            <label for="p_image_upload"> Generated QR code </label>
            <img src="../assets/images/real QR code.png" height="200px" style="margin-top: 5%; margin-bottom: 5%;" alt="" class="p_image_placeholder">
            <br>    
            <label for="r_email_notifier" class="r_email_error_notifier notifier"> Please scan the QR code before you continue</label>
    
        </form>

        <div class="scanned_product_image_container">
            <img src="../assets/images/pexels-kampus-production-7289717.jpg" height="300px" alt="product_avatar">
        </div>

    </div>
    
    <div class="print_button_container">
        <button class="print_voucher_button">Print</button>
    </div>

</body>
</html>