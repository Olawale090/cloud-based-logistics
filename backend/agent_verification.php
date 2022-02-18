<?php

    session_start();

    interface Idelivery_agent_setup {
        public function database_connection();
        public function new_agent_upload_settings();
    }

    class delivery_agent_setup implements Idelivery_agent_setup
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->agent_name = mysqli_real_escape_string($this->mysqli,$_POST['agent_name']);
            $this->agent_email = mysqli_real_escape_string($this->mysqli, $_POST['agent_email']);
            $this->agent_phone_number = mysqli_real_escape_string($this->mysqli, $_POST['agent_phone_number']);
            $this->product_name = mysqli_real_escape_string($this->mysqli, $_POST['product_name']);
            $this->product_quantity = mysqli_real_escape_string($this->mysqli, $_POST['product_quantity']);
            $this->agent_qr_code_url = mysqli_real_escape_string($this->mysqli, $_POST['agent_qr_code_string']);
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function new_agent_upload_settings(){

            if (!empty($this->agent_name) && !empty($this->agent_email) && !empty($this->agent_phone_number) 
                && !empty($this->product_name) && !empty($this->product_quantity) && !empty($this->agent_qr_code_url)){
                    
                    $agent_name = strip_tags($this->agent_name);
                    $agent_email = strip_tags($this->agent_email);
                    $agent_phone_number = strip_tags($this->agent_phone_number);
                    $product_name = strip_tags($this->product_name);
                    $product_quantity = strip_tags( $this->product_quantity);
                    $agent_qr_code = strip_tags($this->agent_qr_code_url);

                    $agent_image_dir = $_SESSION['agent_picture_dir_text'];
                   
                    if ($agent_name && $agent_email && $agent_phone_number && $product_name && $product_quantity && $agent_qr_code) {

                        $agent_query = "    UPDATE agent_verification
                                            SET product_name = '$product_name',
                                                product_quantity = '$product_quantity',
                                                agent_image_dir = '$agent_image_dir',
                                                agent_qr_code_url = '$agent_qr_code'
                                            WHERE agent_phone_number = '$agent_phone_number'; ";

                        $agent_pass_query = $this->mysqli->query($agent_query, MYSQLI_USE_RESULT);

                        if ($agent_pass_query) {

                            echo "Form submitted successfuly";

                        } else {

                            echo 'Form not submitted please try again.';

                        } 
                    

                    } else {

                        echo " Please enter valid product details and check your email ";

                    }

            }
        }

    }

    $agent_setup = new delivery_agent_setup();
    $agent_setup->database_connection();
    $agent_setup->new_agent_upload_settings();














?>