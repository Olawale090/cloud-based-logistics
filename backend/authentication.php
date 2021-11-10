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
                                                 WHERE email = '$email'";

                        $customer_exist_passQuery = $this->mysqli->query($customer_exist_query, MYSQLI_USE_RESULT);
                        $customer_passQuery_data = $customer_exist_passQuery->fetch_array(MYSQLI_ASSOC);

                        if ($customer_passQuery_data['email'] === $email ) {

                                echo "This account already exist, please login."; 

                        }else {

                            $query = "INSERT INTO sign_up(fullname,email,user_password)

                                      VALUES ( '$username', '$email ','$password');";

                            $passQuery = $this->mysqli->query($query, MYSQLI_USE_RESULT);

                            if ($passQuery) {

                                mkdir("../customer/".$username."-".$email);
                                echo "Form submitted successfuly";

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
    // $user_registration->props();
    $user_registration->database_connection();
    $user_registration->new_user_signup();

?>


