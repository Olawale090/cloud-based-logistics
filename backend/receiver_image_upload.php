<?php
    session_start();

    interface Ireceiver_image_update {
        public function database_connection();
        public function receiver_upload_pic();
    }

    class receiver_image_update implements Ireceiver_image_update
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

        public function receiver_upload_pic(){
            echo "receiver picture upload method is working";
            $filename = $_FILES['r_image']['name'];
            $filesize = $_FILES['r_image']['size'];
            $filetemp = $_FILES['r_image']['tmp_name'];

            $receiver_pic_path = $_SESSION['receiver_picture_dir_text'];
            $receiver_serial_number = $_SESSION['receiver_serial_number'];
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$receiver_pic_path.'/'.$filename);

                if ($upload == 1) {
                    
                    $location = $receiver_pic_path.'/'.$filename;

                    $update_img_dir_query = " UPDATE product_pick_up
                                              SET receiver_image_dir = '$location'
                                              WHERE receiver_serial_number = '$receiver_serial_number'; 
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

    $receiver_image_setup = new receiver_image_update();
    $receiver_image_setup->database_connection();
    $receiver_image_setup->receiver_upload_pic();

?>