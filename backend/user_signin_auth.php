<?php

    session_start();

    interface Isignin {

        public function database_connection();
        public function user_signin();

    }

    class log_user_account implements Isignin
    {
        public function __construct() {

            $this->mysqli = new mysqli('localhost','root','','logistics');
            // $this->mysqli = new mysqli('sql104.epizy.com','epiz_30360932','nRfYOoLRfnNnxl','epiz_30360932_logistics');
            $this->email = mysqli_real_escape_string($this->mysqli, $_POST['user_signin_email']);
            $this->password = mysqli_real_escape_string($this->mysqli, $_POST['user_signin_password']);

        }

        public function database_connection(){
            if (mysqli_connect_errno()) {   

                echo " Connection failed, please try again ";

            }
        }

        public function user_signin(){
                
            if (!empty($this->email) && !empty($this->password)) {
                
                $email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
                $password = strip_tags($this->password); 

                    if ($email && $password) {

                        $customer_exist_query = "SELECT * FROM sign_up 
                                                 WHERE email = '$email' 
                                                 AND user_password = $password;
                                                ";

                        $customer_exist_passQuery = $this->mysqli->query($customer_exist_query, MYSQLI_USE_RESULT);
                        $customer_passQuery_data = $customer_exist_passQuery->fetch_array(MYSQLI_ASSOC);

                        if ($customer_passQuery_data) {

                                $_SESSION["user_name"] = $customer_passQuery_data["fullname"];
                                $_SESSION["user_avatar"] = $customer_passQuery_data["user_image_dir"];
                                
                                echo "Login successful"; 
                    
                        }else {

                            echo "Wrong email or password ";

                        }      

                    } 

            }else {

                echo " Please enter email or password ";
            
            }
     
        }
            
            
    }

    $user_account_login = new log_user_account();
    $user_account_login->database_connection();
    $user_account_login->user_signin();

?>


