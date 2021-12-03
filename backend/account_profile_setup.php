<?php
    session_start();

    interface Iaccount_profile_update {
        public function database_connection();
        public function user_account_update();
        public function user_upload_pic();
    }

    class account_profile_update implements Iaccount_profile_update
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->fullname = mysqli_real_escape_string($this->mysqli,$_POST['user_fullname']);
            $this->email = mysqli_real_escape_string($this->mysqli, $_POST['user_email']);
            $this->private_PIN = mysqli_real_escape_string($this->mysqli, $_POST['user_PIN']);
            
        }

        public function database_connection(){
            if (mysqli_connect_errno()) {
                echo " Connection failed, please try again ";
            }
        }

        public function user_account_update(){

            if (!empty($this->fullname) && !empty($this->email)){

                $username = strip_tags($this->fullname);
                $logged_email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
                $pin = strip_tags($this->private_PIN);

                $log_mail = $this->email;

                $update_customer_query = "UPDATE sign_up

                                          SET fullname = '$username', 
                                              email = '$log_mail', 
                                              private_pin = '$pin'

                                          WHERE email = '$log_mail'";

                $update_customer_passQuery = $this->mysqli->query($update_customer_query, MYSQLI_USE_RESULT);

                // echo  $log_mail . " after query ";
                // echo $username;
                // echo $pin;

                // $_SESSION["user_email"] = $email;
                
                if ( $update_customer_passQuery) {
                    
                    echo ' Form submitted successfuly ';

                }else {

                    echo ' Data update failed, please try again. ';
                }



            }else {
                echo " Full name and Email can not be empty ";
            }
                
     
        }

        public function user_upload_pic(){
            
            $filename = $_FILES['user_avatar_upload_btn']['name'];
            $filesize = $_FILES['user_avatar_upload_btn']['size'];
            $filetemp = $_FILES['user_avatar_upload_btn']['tmp_name'];

            $customer_pic_path = $_SESSION["user_avatar_dir"];
            echo $customer_pic_path;
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$customer_pic_path.'/'.$filename);

                echo $upload;

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