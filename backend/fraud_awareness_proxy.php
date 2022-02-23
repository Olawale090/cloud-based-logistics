<?php

    session_start();

    interface Ifraud_awareness {
        public function database_connection();
        public function fraud_report();
    }

    class fraud_awareness_report implements Ifraud_awareness
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->complainant_name = mysqli_real_escape_string($this->mysqli,$_POST['complainant_name']);
            $this->agent_email = mysqli_real_escape_string($this->mysqli, $_POST['agent_email']);
            $this->complaint_box = mysqli_real_escape_string($this->mysqli, $_POST['complaint_box']);
            $this->product_name = mysqli_real_escape_string($this->mysqli, $_POST['product_name']);
            $this->product_delivery_number = mysqli_real_escape_string($this->mysqli, $_POST['product_delivery_number']);
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function fraud_report(){

            if (!empty($this->complainant_name) && !empty($this->agent_email) && !empty($this->complaint_box) && !empty($this->product_name)){
                    
                    $complainant_name = strip_tags($this->complainant_name);
                    $agent_email = strip_tags($this->agent_email);
                    $complaint_box = strip_tags($this->complaint_box);
                    $product_name = strip_tags($this->product_name);
                    $product_delivery_number = strip_tags($this->product_delivery_number);

                    $fraud_image_dir = $_SESSION['fraud_agent_picture_dir_text'];
                   
                    if ($complainant_name && $agent_email && $complaint_box && $product_name) {

                        $fraud_update_query = "    UPDATE fraud_awareness
                                                   SET 
                                                       complaint_box = '$complaint_box'
                                                    --    fraud_agent_picture = '$fraud_image_dir'
                                                   WHERE product_delivery_number = '$product_delivery_number'; 
                                              ";

                       $fraud_awareness_update_query= $this->mysqli->query($fraud_update_query, MYSQLI_USE_RESULT);

                        if ($fraud_awareness_update_query) {

                            echo "Form submitted successfuly".$product_delivery_number;

                        } else {

                            echo 'Form not submitted please try again.';

                        } 
                    

                    } else {

                        echo " Please enter valid product details and check your email ";

                    }

            }
        }

    }

    $agent_setup = new fraud_awareness_report();
    $agent_setup->database_connection();
    $agent_setup->fraud_report();














?>