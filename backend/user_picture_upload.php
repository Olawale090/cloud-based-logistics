<?php
    session_start();

    interface Iaccount_image_update {
        public function database_connection();
        public function user_upload_pic();
    }

    class account_image_update implements Iaccount_image_update
    {
        public function __construct(){

            // $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function user_upload_pic(){
            
            $filename = $_FILES['user_avatar_upload_btn']['name'];
            $filesize = $_FILES['user_avatar_upload_btn']['size'];
            $filetemp = $_FILES['user_avatar_upload_btn']['tmp_name'];

            $customer_pic_path = $_SESSION["user_avatar_dir_text"];
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$customer_pic_path.'/'.$filename);

                if ($upload == 1) {
                    
                    $location = $customer_pic_path.'/'.$filename;

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