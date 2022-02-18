<?php

    session_start();

    class load_user_data
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

        public function user_data_pipe(){

            $piped_mail =  $_SESSION["user_email"];

            $customer_data_query = "SELECT * FROM sign_up 
                                    WHERE email = '$piped_mail'; ";

            $customer_data_passQuery = $this->mysqli->query( $customer_data_query, MYSQLI_USE_RESULT);
            $customer_data_fetch = $customer_data_passQuery->fetch_array(MYSQLI_ASSOC);

            if ($customer_data_fetch) {

                    echo json_encode($customer_data_fetch);
                    $_SESSION["user_avatar_dir_text"] = $customer_data_fetch['user_img_dir']; 

            }

        }
     
    }


    $user_data_pipeline = new load_user_data();
    $user_data_pipeline->database_connection();
    $user_data_pipeline->user_data_pipe();
        
    
?>


