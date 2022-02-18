<?php 

    session_start();

    class product_folder_creator 
    {

        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->product_name = mysqli_real_escape_string($this->mysqli,$_POST['product_name']);
            $this->product_category = mysqli_real_escape_string($this->mysqli, $_POST['product_category']);
            $this->product_quantity = mysqli_real_escape_string($this->mysqli, $_POST['product_quantity']);
            $this->product_delivery_number = mysqli_real_escape_string($this->mysqli, $_POST['product_delivery_number']);

        }

        public function database_connection(){

            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function make_folder(){

            if (!empty($this->product_name) && !empty($this->product_category) && !empty($this->product_quantity) && !empty($this->product_delivery_number) ){
                   
                    $product_name = strip_tags($this->product_name);
                    $product_category = strip_tags($this->product_category);
                    $product_quantity = strip_tags($this->product_quantity);
                    $product_delivery_number = strip_tags($this->product_delivery_number);

                    $_SESSION['product_delivery_number'] = $product_delivery_number;

                    if ($product_name && $product_category && $product_quantity && $product_delivery_number) {
            
                        $product_picture_dir = mkdir("../product_delivery/".$product_category."-".$product_name."-".$product_delivery_number);
                        $product_picture_dir_text = "../product_delivery/".$product_category."-".$product_name."-".$product_delivery_number;

                        $_SESSION['product_picture_dir_text'] = $product_picture_dir_text;


                        $product_query = " INSERT INTO product_delivery(product_name, product_category, product_quantity, product_delivery_number)

                                           VALUES ('$product_name', '$product_category ', '$product_quantity','$product_delivery_number'); ";

                        $product_pass_query = $this->mysqli->query($product_query, MYSQLI_USE_RESULT);

                        if ($product_pass_query) {

                            echo "Form submitted successfuly";

                        } else {

                            echo ' Form not submitted please try again.';
                        }

                    } 

            }
            

        }


    }
    


    $product_folder = new product_folder_creator();
    $product_folder->database_connection();
    $product_folder->make_folder();

?>