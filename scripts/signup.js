"use strict";

// using ES5 structural design pattern to creating objects and API interaction

const signup_authentication = function(){
    
    // signup parameters
    this.user_fullname = document.querySelector(".signup_fullname");
    this.user_email = document.querySelector(".signup_email");
    this.user_password = document.querySelector(".signup_password");
    this.user_confirm_password = document.querySelector(".signup_confirm_password");
    this.user_signup_auth_message = document.querySelector(".signup_auth_message");
    this.user_signup_submit_btn = document.querySelector(".signup_submit_button");

    this.loader = document.querySelector(".form_loader");

};

signup_authentication.prototype ={
   
    user_registration(){

        this.user_signup_submit_btn.addEventListener('click',(event)=>{
            event.preventDefault();

            let params = 'user_fullname=' + this.user_fullname.value + '&user_email=' + this.user_email.value + '&user_password=' + this.user_password.value + '&user_confirm_password=' + this.user_confirm_password.value;
            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/authentication.php',true);
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

                            this.user_signup_auth_message.innerHTML = xhr.responseText;

                            if (xhr.responseText.indexOf("Form submitted successfuly") > -1) {
                                
                                window.open('../','_Self');

                            }

                    } catch (error) {

                        console.error("ERROR GETTING RESPONSE: ", error);

                    }
                    

                } else if(xhr.status === 404) {

                    window.open("../directories/pagenotfound.php","_Self");
                    console.error("PAGE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{
                console.error("ERROR WHILE GETTING RESPONSE ",err);
            };

            xhr.send(params);
        });
    }

}

let auth = new signup_authentication();
auth.user_registration();