<?php
    session_start();

    interface Ifraud_agent_image_update {
        public function database_connection();
        public function upload_agent_pic();
    }

    class fraud_agent_image_update implements Ifraud_agent_image_update
    {
        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            
        }

        public function database_connection(){
            
            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function upload_agent_pic(){
            
            $filename = $_FILES['agent_image']['name'];
            $filesize = $_FILES['agent_image']['size'];
            $filetemp = $_FILES['agent_image']['tmp_name'];

            $fraud_image_dir = $_SESSION['fraud_agent_picture_dir_text'];
            $product_delivery_number = $_SESSION['fraud_product_delivery_number'];
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$fraud_image_dir.'/'.$filename);

                if ($upload == 1) {
                    
                    $location = $fraud_image_dir.'/'.$filename;

                    $update_img_dir_query = " UPDATE fraud_awareness
                                              SET fraud_agent_picture = '$location'
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

    $fraud_agent_image_setup = new fraud_agent_image_update();
    $fraud_agent_image_setup->database_connection();
    $fraud_agent_image_setup->upload_agent_pic();

?>