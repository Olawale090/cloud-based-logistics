<?php 

    session_start();

    class receiver_folder_creator 
    {

        public function __construct(){

            // $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->receiver_name = mysqli_real_escape_string($this->mysqli,$_POST['r_name']);
            $this->receiver_email = mysqli_real_escape_string($this->mysqli, $_POST['r_email']);
            $this->product_quantity = mysqli_real_escape_string($this->mysqli, $_POST['p_quantity']);
            $this->receiver_serial_number = mysqli_real_escape_string($this->mysqli, $_POST['r_serial_number']);
            
        }

        public function database_connection(){

            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function make_folder(){

            if ( !empty($this->receiver_name) && !empty($this->receiver_email) && !empty($this->product_quantity) && !empty($this->receiver_serial_number) ){
            
                    $receiver_name = strip_tags($this->receiver_name);
                    $receiver_email = strip_tags($this->receiver_email);
                    $product_quantity = strip_tags($this->product_quantity);
                    $receiver_serial_number = strip_tags($this->receiver_serial_number);

                    $_SESSION['receiver_serial_number'] = $receiver_serial_number;

                    if ($receiver_name && $receiver_email && $product_quantity && $receiver_serial_number) {
            
                        $receiver_picture_dir = mkdir("../product_pick_up/".$receiver_name."-".$receiver_email."-".$receiver_serial_number);
                        $receiver_picture_dir_text = "../product_pick_up/".$receiver_name."-".$receiver_email."-".$receiver_serial_number;

                        $_SESSION['receiver_picture_dir_text'] = $receiver_picture_dir_text;


                        $receiver_query = " INSERT INTO product_pick_up(receiver_name, receiver_email, product_quantity, receiver_serial_number)
                                            VALUES ('$receiver_name', '$receiver_email', '$product_quantity','$receiver_serial_number'); 
                                          ";

                        $receiver_pass_query = $this->mysqli->query($receiver_query, MYSQLI_USE_RESULT);

                        if ($receiver_pass_query) {

                            echo "Form submitted successfuly";

                        } else {

                            echo ' Form not submitted please try again.';
                        }

                    } 

            }
            

        }


    }
    


    $receiver_folder = new receiver_folder_creator();
    $receiver_folder->database_connection();
    $receiver_folder->make_folder();

?>