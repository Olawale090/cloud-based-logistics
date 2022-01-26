<?php

    session_start();

    class load_product_data
    {
        public function __construct() {

            // $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
        }

        public function database_connection(){

            if (mysqli_connect_errno()) {
                
                echo " Connection failed, please try again ";

            }

        }

        public function product_data_pipe(){

            $product_delivery_number_data =  $_SESSION['product_del_no_data'];

            $product_data_query = " SELECT * FROM product_delivery 
                                    WHERE product_delivery_number = '$product_delivery_number_data'; ";

            $product_data_passQuery = $this->mysqli->query( $product_data_query, MYSQLI_USE_RESULT);
            $product_data_fetch = $product_data_passQuery->fetch_array(MYSQLI_ASSOC);

            if ($product_data_fetch) {

                    echo json_encode($product_data_fetch);

            }

        }
     
    }


    $product_data_pipeline = new load_product_data();
    $product_data_pipeline->database_connection();
    $product_data_pipeline->product_data_pipe();
        
    
?>


