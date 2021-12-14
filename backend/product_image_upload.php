<?php
    session_start();

    interface Iproduct_image_update {
        public function database_connection();
        public function product_upload_pic();
    }

    class product_image_update implements Iproduct_image_update
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function product_upload_pic(){
            
            $filename = $_FILES['product_upload_button']['name'];
            $filesize = $_FILES['product_upload_button']['size'];
            $filetemp = $_FILES['product_upload_button']['tmp_name'];

            $product_pic_path = $_SESSION['product_picture_dir_text'];
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$product_pic_path.'/'.$filename);

                if ($upload == 1) {
                    
                    $location = $product_pic_path.'/'.$filename;

                    $email = $_SESSION["user_email"];

                    $update_img_dir_query = " UPDATE sign_up
                                              SET user_img_dir = '$location'
                                              WHERE email = '$email'; ";

                    $update_img_dir_passQuery = $this->mysqli->query($update_img_dir_query, MYSQLI_USE_RESULT);

                    if ($update_img_dir_passQuery) {

                        echo " Picture updated successfully ";

                    } else {
                        echo " Picture update failed ";
                    }


                } else {
                    echo "Upload failed";
                }
                

            } else {
                echo "Picture size too large";
            }

        }

    }

    $account_user_setup = new account_image_update();
    $account_user_setup->database_connection();
    $account_user_setup->user_upload_pic();

?>