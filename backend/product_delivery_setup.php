<?php
    session_start();

    interface Iproduct_delivery_setup {
        public function database_connection();
        public function new_product_upload_settings();
    }

    class product_delivery_setup implements Iproduct_delivery_setup
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->product_name = mysqli_real_escape_string($this->mysqli,$_POST['product_name']);
            $this->product_category = mysqli_real_escape_string($this->mysqli, $_POST['product_category']);
            $this->product_quantity = mysqli_real_escape_string($this->mysqli, $_POST['product_quantity']);
            $this->product_delivery_number = mysqli_real_escape_string($this->mysqli, $_POST['product_delivery_number']);
            $this->product_receiver_email = mysqli_real_escape_string($this->mysqli, $_POST['r_email']);
            $this->product_image = mysqli_real_escape_string($this->mysqli, $_POST['product_upload_button']);
            $this->product_qr_code_url = mysqli_real_escape_string($this->mysqli, $_POST['qr_code_string']);
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function new_product_upload_settings(){

            if (!empty($this->product_name) && !empty($this->product_category) && !empty($this->product_quantity) 
                && !empty($this->product_delivery_number) && !empty($this->product_receiver_email) && !empty($this->product_qr_code_url)){
                    
                    $product_name = strip_tags($this->product_name);
                    $product_category = strip_tags($this->product_category);
                    $product_quantity = strip_tags($this->product_quantity);
                    $product_delivery_number = strip_tags($this->product_delivery_number);
                    $product_r_email = strip_tags( $this->product_receiver_email);
                    $product_qr_code = strip_tags($this->product_qr_code_url);
                   
                    if ($product_name && $product_category && $product_quantity && $product_delivery_number && $product_r_email && $product_qr_code) {

                        $product_query = " INSERT INTO product_delivery( product_name, product_category, product_quantity, 
                                                                product_delivery_number,product_receiver_email,product_img_dir,
                                                                product_qr_url_string)

                                           VALUES ('$product_name', '$product_category ', '$product_quantity',
                                                  '$product_delivery_number','$product_r_email','','$product_qr_code'); ";

                        $product_pass_query = $this->mysqli->query($product_query, MYSQLI_USE_RESULT);

                        if ($product_pass_query) {

                            echo "Form submitted successfuly";

                            $product_picture_dir = mkdir("../product_delivery/".$product_category."-".$product_name);
                            $product_picture_dir_text = "../product_delivery/".$product_category."-".$product_name;

                        } else {

                            echo ' Form not submitted please try again.';

                        } 
                    

                    } else {
                        echo " Please enter valid product details and check your email ";
                    }

            }
        }

    }

    $product_delivery_setup = new product_delivery_setup();
    $product_delivery_setup->database_connection();
    $product_delivery_setup->new_product_upload_settings();

?>