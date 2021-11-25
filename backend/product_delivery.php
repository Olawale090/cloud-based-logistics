<?php

    session_start();

    interface Iproduct_delivery_setup {

        public function database_connection();
        public function new_product_setup();

    }

    class setup_product implements Iproduct_delivery_setup
    {
        public function __construct() {

            $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->product_name = mysqli_real_escape_string($this->mysqli, $_POST['product_name']);
            $this->product_category = mysqli_real_escape_string($this->mysqli, $_POST['product_category']);
            $this->product_quantity = mysqli_real_escape_string($this->mysqli, $_POST['product_quantity']);
            $this->product_delivery_number = mysqli_real_escape_string($this->mysqli, $_POST['product_delivery_number']);
            $this->product_receiver_email = mysqli_real_escape_string($this->mysqli, $_POST['r_email']);
            $this->product_picture = mysqli_real_escape_string($this->mysqli, $_POST['product_upload_button']);
            $this->product_qrcode_dir = mysqli_real_escape_string($this->mysqli, $_POST['qr_code_string']);

        }

        public function database_connection(){
            if (mysqli_connect_errno()) {
                
                echo " Connection failed, please try again ";

            }
        }

        public function new_product_setup(){
                
            if (!empty($this->product_name) && !empty($this->product_category) && !empty($this->product_quantity) && !empty($this->product_delivery_number) 
                && !empty($this->product_receiver_email) && !empty($this->product_picture) && !empty($this->product_qrcode_dir)) {
                
                $username = strip_tags($this->fullname);
                $email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
                $password = strip_tags($this->password);
                $confirm_password = strip_tags($this->confirm_password); 

                if ($password === $confirm_password) {
                    
                    if ($username && $email && $password) {

                        $customer_exist_query = "SELECT * FROM sign_up 
                                                 WHERE email = '$email'
                                                ";

                        $customer_exist_passQuery = $this->mysqli->query($customer_exist_query, MYSQLI_USE_RESULT);
                        $customer_passQuery_data = $customer_exist_passQuery->fetch_array(MYSQLI_ASSOC);

                        if ($customer_passQuery_data['email'] === $email) {

                                echo "This account already exist, please login."; 

                        }else{

                            $query = "INSERT INTO sign_up(fullname,email,user_password)

                                      VALUES ( '$username', '$email ','$password');";

                            $passQuery = $this->mysqli->query($query, MYSQLI_USE_RESULT);

                            if ($passQuery) {

                                mkdir("../customer/".$username."-".$email);
                                echo "Form submitted successfuly";
                                // $_SESSION["user_name"] =  $username;

                            } else {

                                echo ' Form not submitted please try again.';

                            } 
                        }

                    } else {
                       echo " Please enter valid email ";
                    }

                } else {
                    echo " Your password must match ";
                }
                

            } else {
                echo " Please fill the empty field(s) ";
            }
     
    }
            
            
    }

    $user_registration = new register_user();
    $user_registration->database_connection();
    $user_registration->new_user_signup();

?>


