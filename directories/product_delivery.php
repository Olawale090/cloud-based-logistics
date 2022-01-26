<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/product_actions.css">
    <link rel="stylesheet" href="../styles/product_delivery.css">
    <link rel="stylesheet" href="../styles/loader.css">

    <script async type="module" src="../scripts/product_delivery.js"></script>
    <script src="../scripts/qrcode.js"></script>

    <title>Product delivery</title>
    
</head>
<body>

    <div class="nav_panel">
        <div class="left_float">
            <img src="../assets/images/Group 145 copy.svg" alt="c_avatar" class="avatar">
        </div>
        
        <div class="right_float">

            <li class="profile_tabs picking_product"> 
                <a href="../directories/product_pick_up.html" class="picking_dir"> Picking product  </a>
            </li> 

            <li class="profile_tabs verify_agent"> 
                <a href="../directories/agent_verification.html" class="picking_dir"> Verify Agent </a>
            </li>

            <li class="profile_tabs fraud_awareness">
                <a href="../directories/fraud_awareness.html" class="picking_dir"> Fraud awareness </a>
            </li>

            <li class="profile_tabs dashboard">
                <a href="../directories/dashboard.php" class="picking_dir"> Dashboard </a>
            </li>

            <li class="profile_tabs username profile_username">Username</li>
            <img src="../assets/images/e0e69226-9ff0-4e4e-a0fe-5ad8555a07e8.jpg" alt="u_avatar" class="avatar u_avatar user_image_placeholder">

        </div>
        
    </div>

    <div class="product_activities_hero">

        <div class="product_activity_title">
            Product delivery
        </div>
        <img src="../assets/images/030-shipping.svg" alt="action_image" class="product_activity_image">
            
    </div>

    
    <form action="" method="post" class="product_delivery_registration">

        <label for="p_name">Product name</label>
        <input type="text" placeholder="Please enter product name" name="product_name" class="product_name" >
        <label for="p_name_notifier" class="p_name_error_notifier notifier">Please enter the product name</label>

        <label for="P_category"> Product category </label>
        <input type="text" placeholder="Please enter product category" name="product_category" class="product_category">
        <label for="p_category_notifier" class="p_category_error_notifier notifier"> Please enter the product category </label>

        <div class="p_quantity_delivery_number">

            <div class="product_quantity">

                <label for="p_quantity"> Product quantity </label>
                <input type="text" placeholder="Please enter product quantity" name="product_quantity" class="product_quantity_input" >
                <label for="p_delivery_number_notifier" class="p_quantity_error_notifier notifier"> Please enter product quantity </label>
                
            </div>

            <div class="product_delivery_number">

                <label for="p_delivery_number"> Product delivery number </label>
                <input type="text" placeholder="Please enter product delivery number" name="product_delivery_number" class="product_delivery_number_input">

                <div class="number_value_button">
                    <button class="number_generator"> Get number </button>
                    <label class="number_value_placeholder"> 793651109 </label>
                </div>
                
                
            </div>
            
        </div>

        <label for="receiver_email"> Receiver's email </label>
        
        <input type="text" placeholder="Please enter receiver's email" name="r_email" class="r_email">
        <label for="r_email_notifier" class="r_email_error_notifier notifier"> Please enter receiver's email </label>

        <label for="p_image_upload"> Upload product image </label>
        <label for="upload" class="p_img_upload_lb"> Select image </label> 
        <input type="file" placeholder="Select image" name="product_upload_button" class="product_upload_button"> 

        <img src="../assets/images/033-user.svg" height="200px" alt="" class="p_image_placeholder">

        <div class="form_loader"></div>

        <label for="image_upload_notifier" class="p_image_upload_notifier notifier"> Please select image to upload </label>

        <label for="p_qr"> Autogenerated QR code </label>
        <!-- <img src="../assets/images/real QR code.png" alt="qr_code" class="img_qr_code"> -->

        <div class="img_qr_code" style="width:35%; margin-left:32.5%; margin-bottom:1rem;"></div>

        <input type="text" name="qr_code_string" placeholder="URL qr strings" id="text" class="qr_code_container">
         
        <button class="print_qr_pdf">Print QR</button>
        <button name="product_delivery_submit_btn" class="product_delivery_submit_btn"> Submit </button>

        <div class="form_loader"></div>

        <div class="product_form_notifier"> </div>

        <label for="next_btn" class="next_btn"> next >> </label>
    </form>
    
</body>
</html>