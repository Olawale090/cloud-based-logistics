<?php
    session_start();

    interface Iproduct_image_update {
        public function database_connection();
        public function product_upload_pic();
    }

    class product_image_update implements Iproduct_image_update
    {
        public function __construct(){

            // $this->mysqli = new mysqli('localhost','root','','logistics');
            $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function product_upload_pic(){
            
            $filename = $_FILES['product_upload_button']['name'];
            $filesize = $_FILES['product_upload_button']['size'];
            $filetemp = $_FILES['product_upload_button']['tmp_name'];

            $product_pic_path = $_SESSION['product_picture_dir_text'];
            $product_delivery_number = $_SESSION['product_delivery_number'];
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$product_pic_path.'/'.$filename);

                if ($upload == 1) {
                    
                    $location = $product_pic_path.'/'.$filename;

                    $update_img_dir_query = " UPDATE product_delivery
                                              SET product_img_dir = '$location'
                                              WHERE product_delivery_number = '$product_delivery_number'; 
                                            ";

                    $update_img_dir_passQuery = $this->mysqli->query($update_img_dir_query, MYSQLI_USE_RESULT);

                    if ($update_img_dir_passQuery) {

                        echo " Picture updated successfully ";

                    } else {
                        echo " Picture update failed ";
                    }


                } else {
                    echo "Upload failed";
                }
                

            } else {
                echo "Picture size too large, file larger than 2MB";
            }

        }

    }

    $product_image_setup = new product_image_update();
    $product_image_setup->database_connection();
    $product_image_setup->product_upload_pic();

?>