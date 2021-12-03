<?php

    session_start();

    interface Isignup {

        // public function props();
        public function database_connection();
        public function new_user_signup();

    }

    class register_user implements Isignup
    {
        public function __construct() {

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->fullname = mysqli_real_escape_string($this->mysqli, $_POST['user_fullname']);
            $this->email = mysqli_real_escape_string($this->mysqli, $_POST['user_email']);
            $this->password = mysqli_real_escape_string($this->mysqli, $_POST['user_password']);
            $this->confirm_password = mysqli_real_escape_string($this->mysqli, $_POST['user_confirm_password']);

        }

        public function database_connection(){
            if (mysqli_connect_errno()) {
                
                echo " Connection failed, please try again ";

            }
        }

        public function new_user_signup(){
                
            if (!empty($this->fullname) && !empty($this->email) && !empty($this->password) && !empty($this->confirm_password)) {
                
                $username = strip_tags($this->fullname);
                $email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
                $password = strip_tags($this->password);
                $confirm_password = strip_tags($this->confirm_password); 

                if ($password === $confirm_password) {
                    
                    if ($username && $email && $password) {

                        $customer_exist_query = "SELECT * FROM sign_up 
                                                 WHERE email = '$email'; ";

                        $customer_exist_passQuery = $this->mysqli->query($customer_exist_query, MYSQLI_USE_RESULT);
                        $customer_passQuery_data = $customer_exist_passQuery->fetch_array(MYSQLI_ASSOC);

                        // $x = substr($customer_passQuery_data['email'],0,20);
                        // $y = substr($email,0,20);

                        // if($x == $y){
                        //     echo "working";
                        // }

                        // echo substr_compare($customer_passQuery_data['email'],$email,0,strlen($customer_passQuery_data['email']));

                        if (substr_compare($customer_passQuery_data['email'],$email,0,20) > -1) {

                                echo " This account already exist, please login. "; 

                        }else{

                            $query = "INSERT INTO sign_up(fullname,email,user_password)
                                      VALUES ( '$username', '$email ','$password');";

                            $passQuery = $this->mysqli->query($query, MYSQLI_USE_RESULT);

                            if ($passQuery) {

                                echo "Form submitted successfuly";

                                $picture_dir = mkdir("../customer/".$username."-".$email);
                                $picture_dir_text = "../customer/".$username."-".$email;
                                $_SESSION["user_avatar_dir_text"] = $picture_dir_text;

                                // echo $picture_dir_text;

                                // $picture_dir = $_SESSION["user_avatar_dir"];

                                $update_img_dir_query = "   UPDATE sign_up

                                                            SET user_img_dir = '$picture_dir_text' 

                                                            WHERE email = '$email'";

                                $update_img_dir_passQuery = $this->mysqli->query($update_img_dir_query, MYSQLI_USE_RESULT);


                            } else {

                                echo ' Form not submitted please try again.';

                            } 
                        }

                    } else {
                       echo " Please enter valid email ";
                    }

                } else {
                    echo " Your password must match ";
                }
                

            } else {
                echo " Please fill the empty field(s) ";
            }
     
    }
            
            
    }

    $user_registration = new register_user();
    $user_registration->database_connection();
    $user_registration->new_user_signup();

?>


