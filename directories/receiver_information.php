<!-- <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/product_actions.css">
        <link rel="stylesheet" href="../styles/loader.css">

        <title>Receiver information</title>

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

                    <li class="profile_tabs account_profile"> 
                        <a href="../directories/account_profile.html" class="picking_dir"> Account profile </a> 
                    </li>

                    <li class="profile_tabs fraud_awareness">
                        <a href="../directories/fraud_awareness.html" class="picking_dir"> Fraud awareness </a>
                    </li>

                    <li class="profile_tabs dashboard">
                        <a href="../directories/dashboard.html" class="picking_dir"> Dashboard </a>
                    </li>


                    <li class="profile_tabs username profile_username"> Username </li>
                    
                    <img src="../assets/images/e0e69226-9ff0-4e4e-a0fe-5ad8555a07e8.jpg" alt="u_avatar" class="avatar u_avatar user_image_placeholder">
                </div>
                
            </div>

            <div class="product_activities_hero">

                <div class="product_activity_title">
                    Receiver's Information
                </div>

                <img src="../assets/images/011-delivery man.svg" alt="action_image" class="product_activity_image">

            </div>
                    
        </div> -->

        <!-- <div class="scanned_product_data">

            <form action="" method="get" class="scanned_product_data_texts">

                <label for="p_name"> Product name</label>
                <div class="p_name_value">'. $product_data_fetch['product_name']. ' </div>

                <label for="P_category"> Product category </label>
                <div class="p_name_value">' . $product_data_fetch['product_category']. '</div>

                <label for="P_category"> Product quantity </label>
                <div class="p_name_value"> ' . $product_data_fetch['product_quantity']. ' </div>

                <label for="p_delivery_number"> Product delivery number </label>
                <div class="p_name_value">' . $product_data_fetch['product_delivery_number']. '</div>
                
                <label for="p_receiver_phone"> Receivers e-mail </label>
                <div class="p_name_value">' . $product_data_fetch['product_receiver_email']. '</div>
                
                
                <label for="p_image_upload"> Generated QR code </label>
                <img src="../assets/images/real QR code.png" height="200px" style="margin-top: 5%; margin-bottom: 5%;" alt="" class="p_image_placeholder">
                <br>    
                <label for="r_email_notifier" class="r_email_error_notifier notifier"> Please scan the QR code ( It contain Product receiver details ) </label>

            </form>

            <div class="scanned_product_image_container">
                <img src="'.$product_data_fetch['product_img_dir'].'" height="300px" alt="product_avatar">
            </div>

        </div> -->
        
<!-- </body>
</html> -->


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="../assets/images/Group 49.svg" type="image/x-icon">
        <link rel="stylesheet" href="../styles/product_actions.css">
        <link rel="stylesheet" href="../styles/order_verification.css">

        <!-- <script async type="module" src="../scripts/order_verification.js"></script> -->
        <script async type="module" src="../scripts/pipe.js"></script>

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


                <li class="profile_tabs username profile_username"> Username </li>
                <img src="../assets/images/e0e69226-9ff0-4e4e-a0fe-5ad8555a07e8.jpg" alt="u_avatar" class="avatar u_avatar">
            </div>
            
        </div>

            <div class="product_activities_hero">

                <div class="product_activity_title">
                    Receiver's Information
                </div>

                <img src="../assets/images/011-delivery man.svg" alt="action_image" class="product_activity_image">

            </div>

        <!-- <input type="text" name="manual_product_delivery_number" class="manual_product_delivery_number_input"> -->

    <?php

        // session_start();

        class load_receiver_data
        {
            public function __construct() {

                $this->mysqli = new mysqli('localhost','root','','logistics');
                // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');

            }

            public function database_connection(){

                if (mysqli_connect_errno()) {
                    
                    echo " Connection failed, please try again ";

                }

            }

            public function receiver_data_pipe(){

                $receiver_email =  $_GET['receiver_email']; 
                $receiver_serial_number =  $_GET['receiver_serial_number'];

                $receiver_data_query = "SELECT * FROM product_pick_up 
                                        WHERE receiver_serial_number = '$receiver_serial_number'
                                        AND receiver_email = '$receiver_email'; 
                                        ";

                $receiver_data_passQuery = $this->mysqli->query( $receiver_data_query, MYSQLI_USE_RESULT);
                $receiver_data_fetch = $receiver_data_passQuery->fetch_array(MYSQLI_ASSOC);


                if ($receiver_data_fetch) {

                    echo ' 
                        <div class="scanned_product_data">

                            <form action="" method="get" class="scanned_product_data_texts">

                                <label for="p_name"> Receiver name</label>
                                <div class="p_name_value">'. $receiver_data_fetch['receiver_name']. ' </div>
                        
                                <label for="P_category"> Receiver E-mail </label>
                                <div class="p_name_value">' . $receiver_data_fetch['receiver_email']. '</div>

                                <label for="P_category"> Product quantity </label>
                                <div class="p_name_value"> ' . $receiver_data_fetch['product_quantity']. ' </div>

                                <label for="p_delivery_number"> Receiver serial number </label>
                                <div class="p_name_value">' . $receiver_data_fetch['receiver_serial_number']. '</div>
                                
                                <label for="p_receiver_phone"> Receivers address </label>
                                <div class="p_name_value">' . $receiver_data_fetch['receiver_address']. '</div>
                                
                                
                                <label for="p_image_upload"> Generated QR code </label>
                                <img src="../assets/images/real QR code.png" height="200px" style="margin-top: 5%; margin-bottom: 5%;" alt="" class="p_image_placeholder">
                                <br>    
                                <label for="r_email_notifier" class="r_email_error_notifier notifier"> Please scan the QR code ( It contain Product receiver details ) </label>
                        
                            </form>

                            <div class="scanned_product_image_container">
                                <img src="'.$receiver_data_fetch['receiver_image_dir'].'" height="300px" alt="product_avatar">
                            </div>

                        </div>';

                }

            }
        
        }


        $receiver_data_pipeline = new load_receiver_data();
        $receiver_data_pipeline->database_connection();
        $receiver_data_pipeline->receiver_data_pipe();
            
        
    ?>
        
        <div class="print_button_container">
            <button class="print_voucher_button">Print</button>
        </div>

    </body>
</html>



