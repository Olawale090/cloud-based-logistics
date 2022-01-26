"use strict";

// using ES5 structural design pattern to creating objects and API interaction

const signin_authentication = function(){
    
    // signup parameters
   
    this.user_email = document.querySelector(".signin_email");
    this.user_password = document.querySelector(".signin_password");
    this.user_signin_auth_message = document.querySelector(".signin_auth_message");
    this.user_signin_submit_btn = document.querySelector(".signin_btn");

    this.loader = document.querySelector(".form_loader");
    
};

signin_authentication.prototype ={
   
    user_account_login(){

        this.user_signin_submit_btn.addEventListener('click',(event)=>{

            event.preventDefault();

            // console.dir(this.user_signin_auth_message);

            let params =  'user_signin_email=' + this.user_email.value + '&user_signin_password=' + this.user_password.value;
            const xhr = new XMLHttpRequest();
            xhr.open('POST','./backend/user_signin_auth.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onloadstart = ()=>{

                this.loader.style.display = "block";
                
            };

            xhr.onloadend = ()=>{

                this.loader.style.display = "none";
                
            };


            xhr.onload = ()=>{
                if (xhr.status === 200) {
                    try {
                        this.user_signin_auth_message.innerHTML = xhr.responseText;

                        if (xhr.responseText.indexOf("Login successful") > -1) {

                            this.user_signin_auth_message.style.color = "rgb(40, 230, 113)";
                            window.open('./directories/dashboard.php','_Self');

                        }

                    } catch (error) {

                        console.error("ERROR OCCURED WHILE GETTING RESPONSE", error);

                    }
                    
                } else if(xhr.status === 404) {

                   window.open("./directories/pagenotfound.php","_Self");
                   console.error("PAGE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{
                console.error("ERROR IN MAKING SERVER REQUEST",err);
            };

            xhr.send(params);
        });
    }

}

let auth = new signin_authentication();
auth.user_account_login();