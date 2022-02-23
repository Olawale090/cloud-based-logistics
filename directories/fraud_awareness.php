<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/product_actions.css">
    <link rel="stylesheet" href="../styles/fraud_awareness.css">

    <script async type="module" src="../scripts/fraud_awareness.js"></script>

    <title>Fraud awareness</title>

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
            
            <li class="profile_tabs username">Username</li>
            <img src="../assets/images/e0e69226-9ff0-4e4e-a0fe-5ad8555a07e8.jpg" alt="u_avatar" class="avatar u_avatar">
        </div>
        
    </div>

    <div class="product_activities_hero">

        <div class="product_activity_title">
            Fraud awareness
        </div>
        <img src="../assets/images/027-quality.svg" alt="action_image" class="product_activity_image">
            
    </div>

    <form action="" method="post" class="product_delivery_registration fraud_awareness_form">

        <div class="info_box" id="printme">
            Product receivers or customers expecting goods are to ensure that immediate notification is made to let your product sender know
            of any fraudulent practises usually extral charges by delivery agents and unverifiable delivery agent. Therefore you are advised NOT to
            pay to any delivery agent directly and also all agents matched with your goods must be verified through their QR code.
        </div>
        
        <label for="p_name">Complainant's name</label>
        <input type="text" name="complainant_name" placeholder="Please enter agent name" class="complainant_name" >
        <label for="p_name_notifier" class="complainant_name_error_notifier notifier">Please enter Complainant's name</label>

        <label for="P_category"> Agent's email </label>
        <input type="text" name="agent_email" placeholder="Please enter agent's email" class="agent_email">
        <label for="p_category_notifier" class="agent_email_error_notifier notifier"> Please enter the agent's email </label>

        <label for="p_name">Customer complain</label>
        <textarea type="text" name="complaint_box" placeholder="Please explain incident" class="complaint_box" height="500px">  </textarea>
        <label for="r_email_notifier" class="complain_box_error_notifier notifier"> Please explain incident </label>

        <label for="p_name">Product name</label>
        <input type="text" name="product_name" placeholder="Please enter product name" class="product_name" >
        <label for="p_name_notifier" class="p_name_error_notifier notifier"> Please enter the product name </label>

        <label for="p_name">Product delivery number</label>
        <input type="text" name="product_delivery_number" placeholder="Please enter product delivery number" class="product_delivery_number" >
        <label for="p_delivery_number_notifier" class="p_delivery_number_error_notifier notifier"> Please enter the product delivery number </label>

        <label for="p_image_upload"> Upload agent's image </label>
        <label for="upload" class="p_img_upload_lb"> Select image </label> 
        <input type="file" name="agent_image" placeholder="Select image" class="product_upload_button agent_image_picker"> 
        

        <img src="../assets/images/033-user.svg" height="200px" alt="" class="p_image_placeholder agent_image_placeholder">
        <div class="form_loader"></div>

        <label for="image_upload_notifier" class="fraud_upload_notifier notifier"> Please select image to upload </label>

        <button name="" class="fraud_awareness_submit_btn"> Submit </button>
        <div class="fraud_form_notifier"> </div>
        
    </form>

</body>
</html>