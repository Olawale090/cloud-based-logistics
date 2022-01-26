<?php
    session_start();

    interface Iaccount_profile_update {
        public function database_connection();
        public function user_account_update();
    }

    class account_profile_update implements Iaccount_profile_update
    {
        public function __construct(){

            // $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
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
                
                if ( $update_customer_passQuery) {
                    
                    echo ' Form submitted successfuly ';

                }else {

                    echo ' Data update failed, please try again. ';
                }



            }else {
                echo " Full name and Email can not be empty ";
            }
                
     
        }

       

    }

    $account_profile_setup = new account_profile_update();
    $account_profile_setup->database_connection();
    $account_profile_setup->user_account_update();

?>