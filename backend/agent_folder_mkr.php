<?php 

    session_start();

    class agent_folder_creator 
    {

        public function __construct(){

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->agent_name = mysqli_real_escape_string($this->mysqli,$_POST['agent_name']);
            $this->agent_email = mysqli_real_escape_string($this->mysqli, $_POST['agent_email']);
            $this->agent_phone_number = mysqli_real_escape_string($this->mysqli, $_POST['agent_phone_number']);

        }

        public function database_connection(){

            if (mysqli_connect_errno()) {

                echo " Connection failed, please try again ";

            }

        }

        public function make_folder(){

            if (!empty($this->agent_name) && !empty($this->agent_email) && !empty($this->agent_phone_number)){
                   
                    $agent_name = strip_tags($this->agent_name);
                    $agent_email = strip_tags($this->agent_email);
                    $agent_phone_number = strip_tags($this->agent_phone_number);

                    $_SESSION['agent_phone_number'] = $agent_phone_number;

                    if ($agent_name && $agent_email && $agent_phone_number) {
            
                        $agent_picture_dir = mkdir("../agents/".$agent_name."-".$agent_email."-".$agent_phone_number);
                        $agent_picture_dir_text = "../agents/".$agent_name."-".$agent_email."-".$agent_phone_number;

                        $_SESSION['agent_picture_dir_text'] =  $agent_picture_dir_text;


                        $agent_query = " INSERT INTO agent_verification(agent_name, agent_email, agent_phone_number)

                                           VALUES ('$agent_name', '$agent_email', '$agent_phone_number'); ";

                        $agent_pass_query = $this->mysqli->query($agent_query, MYSQLI_USE_RESULT);

                        if ($agent_pass_query) {

                            echo "Form submitted successfuly";

                        } else {

                            echo ' Form not submitted please try again.';
                        }

                    } 

            }
            

        }


    }
    


    $agent_folder = new agent_folder_creator();
    $agent_folder->database_connection();
    $agent_folder->make_folder();

?>