<?php
    session_start();

    interface Iaccount_image_update {
        public function database_connection();
        public function user_upload_pic();
    }

    class account_image_update implements Iaccount_image_update
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            
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

            echo $customer_pic_path;
            echo $filename . " file name concatenated ";
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$customer_pic_path.'/'.$filename);

                echo $customer_pic_path.'/'.$filename;

                if ($upload == 1) {
                    
                    $location = $customer_pic_path.'/'.$filename;

                    $email = $this->email;

                    $location_query = " UPDATE signup
                                        SET user_image_dir = $location
                                        WHERE email = '$email'";

                    if ($location_query) {

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

    $account_profile_setup = new account_profile_update();
    $account_profile_setup->database_connection();
    $account_profile_setup->user_account_update();
    $account_profile_setup->user_upload_pic();

?>