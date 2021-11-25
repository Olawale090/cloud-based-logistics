<?php
    session_start();

    interface Iaccount_profile_update {
        public function database_connection();
        public function user_account_update();
    }

    class account_profile_update implements Iaccount_profile_update
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->username = mysqli_real_escape_string($this->mysqli,$_POST['username']);
            $this->email = mysqli_real_escape_string($this->mysqli, $_POST['user_email']);
            $this->private_PIN = mysqli_real_escape_string($this->mysqli, $_POST['user_PIN']);
            $this->image_file = $_FILES['user_avatar_upload_btn'];
            
        }

        public function database_connection(){
            if (mysqli_connect_errno()) {
                echo " Connection failed, please try again ";
            }
        }

        public function user_account_update(){
                    
                $username = strip_tags($this->username);
                $email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
                $pin = strip_tags($this->private_PIN);

                $update_customer_query = "UPDATE signup

                                          SET fullname = '$username', 
                                              email = '$email', 
                                              private_pin = '$pin',

                                          WHERE email = '$email'";

                $update_customer_passQuery = $this->mysqli->query($customer_exist_query, MYSQLI_USE_RESULT);

                $_SESSION["user_email"] = $email;
                
                if ( $update_customer_passQuery) {
                    
                    echo ' Form submitted successfuly ';

                }else {

                    echo ' Data update failed, please try again. ';
                }
     
        }

        public function user_upload_pic(){
            
            $filename = $this->image_file['name'];
            $filesize = $this->image_file['size'];
            $filetemp = $this->image_file['tmp_name'];

            $cutomer_pic_path = $_SESSION["user_avatar_dir"];
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$customer_pic_path.'/'.$filename);

                if ($upload == 1) {
                    
                    $location = $customer_pic_path.'/'.$filename;

                    $new_email = $_SESSION['user_email'];

                    $location_query = " UPDATE signup
                                        SET user_image_dir = $location
                                        WHERE email = '$new_email'";

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