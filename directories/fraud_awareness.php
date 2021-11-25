<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
    <link rel="stylesheet" href="../styles/product_actions.css">

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

    <form action="" method="post" class="product_delivery_registration">

        <div class="info_box">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse similique quidem distinctio ex voluptatum eum eos corrupti. Quos quisquam veniam culpa, dolor rerum harum. Harum modi nesciunt velit ex fuga!
            Cum illo excepturi itaque quasi, odit laudantium. Cumque commodi odit neque hic expedita necessitatibus, harum est blanditiis et odio atque non quidem numquam placeat quam, eveniet asperiores ab dicta! Aspernatur!
            Odio, non! Consectetur libero sunt suscipit architecto repellat delectus dignissimos enim aperiam quae consequuntur nesciunt impedit nemo, sed necessitatibus optio aliquam odit earum fuga minus in. Quis recusandae cupiditate similique.
        </div>

        <label for="p_name">Complainants's name</label>
        <input type="text" placeholder="Please enter agent name" class="product_name" >
        <label for="p_name_notifier" class="p_name_error_notifier notifier">Please enter Complainant's name</label>

        <label for="P_category"> Agent's email </label>
        <input type="text" placeholder="Please enter agent's email" class="product_category">
        <label for="p_category_notifier" class="p_category_error_notifier notifier"> Please enter the agent's email </label>

        <textarea type="text" placeholder="Please explain incident" class="complaint_box" height="500px">  </textarea>
        <label for="r_email_notifier" class="r_email_error_notifier notifier"> Please explain incident </label>

        <label for="p_name">Product name</label>
        <input type="text" placeholder="Please enter product name" class="product_name" >
        <label for="p_name_notifier" class="p_name_error_notifier notifier"> Please enter the product name </label>

        <label for="p_image_upload"> Upload agent's image </label>
        <label for="upload" class="p_img_upload_lb"> Select image </label> 
        <input type="file" placeholder="Select image" class="product_upload_button"> 
        

        <img src="../assets/images/3196a15c34a94fd18c4bf047815fde18.jpg" height="200px" alt="" class="p_image_placeholder">

        <label for="image_upload_notifier" class="p_image_upload_notifier notifier"> Please select image to upload </label>

        <label for="p_qr"> Autogenerated QR code of the product </label>
        <img src="../assets/images/024-qr-code.svg" alt="qr_code" class="img_qr_code">
        
        <button class="print_qr_pdf">Print QR</button>
        <button name="" class="product_delivery_submit_btn"> Submit </button>
        <label for="next_btn" class="next_btn"> next >> </label>
        
    </form>

</body>
</html>