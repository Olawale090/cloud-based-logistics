<?php
    session_start();

    interface Iagent_image_update {
        public function database_connection();
        public function agent_upload_pic();
    }

    class agent_image_update implements Iagent_image_update
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

        public function agent_upload_pic(){
            
            $filename = $_FILES['agent_picture_image']['name'];
            $filesize = $_FILES['agent_picture_image']['size'];
            $filetemp = $_FILES['agent_picture_image']['tmp_name'];

            $agent_pic_path = $_SESSION['agent_picture_dir_text'] ;
            $agent_phone_number = $_SESSION['agent_phone_number'];
            
            if ($filesize < 2000000) {

                $upload = move_uploaded_file($filetemp,$agent_pic_path.'/'.$filename);

                if ($upload == 1) {
                    
                    $location = $agent_pic_path.'/'.$filename;

                    $update_img_dir_query = " UPDATE agent_verification
                                              SET agent_image_dir = '$location'
                                              WHERE agent_phone_number = '$agent_phone_number'; 
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

    $agent_image_setup = new agent_image_update();
    $agent_image_setup->database_connection();
    $agent_image_setup->agent_upload_pic();

?>