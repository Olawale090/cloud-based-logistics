<?php 

    session_start();

    class fraud_awareness_folder_creator 
    {

        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->complainant_name = mysqli_real_escape_string($this->mysqli,$_POST['complainant_name']);
            $this->agent_email = mysqli_real_escape_string($this->mysqli, $_POST['agent_email']);
            $this->product_name = mysqli_real_escape_string($this->mysqli, $_POST['product_name']);
            $this->product_delivery_number = mysqli_real_escape_string($this->mysqli, $_POST['product_delivery_number']);

        }

        public function database_connection(){

            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function make_folder(){

            if (!empty($this->complainant_name) && !empty($this->agent_email) && !empty($this->product_name) && !empty($this->product_delivery_number)){
                   
                $complainant_name = strip_tags($this->complainant_name);
                $agent_email = strip_tags($this->agent_email);
                $product_name = strip_tags($this->product_name);
                $product_delivery_number = strip_tags($this->product_delivery_number);

                
                // $_SESSION['fraud_product_delivery_number'] = $product_delivery_number;
                // echo $_SESSION['fraud_product_delivery_number'];

                if ($complainant_name && $agent_email && $product_name) {
        
                    $fraud_agent_picture_dir = mkdir("../fraud_awareness/".$complainant_name."-".$agent_email."-".$product_name."-".$product_delivery_number);
                    $fraud_agent_picture_dir_text = "../fraud_awareness/".$complainant_name."-".$agent_email."-".$product_name."-".$product_delivery_number;

                    $_SESSION['fraud_agent_picture_dir_text'] = $fraud_agent_picture_dir_text;


                    $fraud_query = " INSERT INTO fraud_awareness(complainant_name, agent_email, product_name, product_delivery_number)

                                        VALUES ('$complainant_name', '$agent_email', '$product_name','$product_delivery_number'); ";

                    $fraud_pass_query = $this->mysqli->query($fraud_query, MYSQLI_USE_RESULT);

                    if ($fraud_pass_query) {

                        echo "Form submitted successfuly";

                    } else {

                        echo ' Form not submitted please try again.';
                    }

                } 

            }
            

        }


    }
    


    $fraud_awareness_folder = new fraud_awareness_folder_creator();
    $fraud_awareness_folder->database_connection();
    $fraud_awareness_folder->make_folder();

?>