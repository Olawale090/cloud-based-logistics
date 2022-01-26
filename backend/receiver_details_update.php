<?php
    session_start();

    interface Ireceiver_pick_up_setup {
        public function database_connection();
        public function new_receiver_account_settings();
    }

    class receiver_pick_up_setup implements Ireceiver_pick_up_setup
    {
        public function __construct(){

            // $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->receiver_name = mysqli_real_escape_string($this->mysqli,$_POST['r_name']);
            $this->receiver_email = mysqli_real_escape_string($this->mysqli, $_POST['r_email']);
            $this->product_quantity = mysqli_real_escape_string($this->mysqli, $_POST['p_quantity']);
            $this->receiver_serial_number = mysqli_real_escape_string($this->mysqli, $_POST['r_serial_number']);
            $this->receiver_address = mysqli_real_escape_string($this->mysqli, $_POST['r_address']);
            $this->receiver_qr_code_url = mysqli_real_escape_string($this->mysqli, $_POST['r_qr_code_string']);
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function new_receiver_account_settings(){

            if (!empty($this->receiver_name) && !empty($this->receiver_email) && !empty($this->product_quantity) 
                && !empty($this->receiver_serial_number) && !empty($this->receiver_address) && !empty($this->receiver_qr_code_url)){
                    
                    $receiver_name = strip_tags($this->receiver_name);
                    $receiver_email = strip_tags($this->receiver_email);
                    $product_quantity = strip_tags($this->product_quantity);
                    $receiver_serial_number = strip_tags($this->receiver_serial_number);
                    $receiver_address = strip_tags($this->receiver_address);
                    $receiver_qr_code_url = strip_tags($this->receiver_qr_code_url);
                   
                    if ($receiver_name && $receiver_email && $product_quantity && $receiver_serial_number && $receiver_address && $receiver_qr_code_url) {

                        $receiver_query = "  UPDATE product_pick_up
                                             SET receiver_email = '$receiver_email',
                                                 receiver_address ='$receiver_address',
                                                 receiver_qrcode_url = '$receiver_qr_code_url'
                                             WHERE receiver_serial_number = '$receiver_serial_number'; 
                                          ";

                        $receiver_pass_query = $this->mysqli->query($receiver_query, MYSQLI_USE_RESULT);

                        if ($receiver_pass_query) {

                            echo "Form submitted successfuly" .  $receiver_qr_code_url;

                        } else {

                            echo ' Form not submitted please try again.';

                        } 
                    

                    } else {
                        echo " Please enter valid product details and check your email ";
                    }

            }
        }

    }

    $receiver_pick_up_setup = new receiver_pick_up_setup();
    $receiver_pick_up_setup->database_connection();
    $receiver_pick_up_setup->new_receiver_account_settings();

?>