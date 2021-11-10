"use strict";

// using ES5 structural design pattern to creating objects and API interaction

const signin_authentication = function(){
    
    //signin parameters
    this.email = document.querySelector(".signin_email");
    this.password = document.querySelector(".signin_password");
    this.auth_message = document.querySelector(".form_auth_message");
    this.submit_btn = document.querySelector(".signin_btn");

    // signup parameters
    this.user_fullname = document.querySelector(".signup_fullname");
    this.user_email = document.querySelector(".signup_email");
    this.user_password = document.querySelector(".signup_password");
    this.user_confirm_password = document.querySelector(".signup_confirm_password");
    this.user_signup_auth_message = document.querySelector(".signup_auth_message");
    this.user_signup_submit_btn = document.querySelector(".signup_submit_button");
};

signin_authentication.prototype ={
    validateSigninForm(){
        this.submit_btn.addEventListener('click',(event)=>{
            event.preventDefault();

            if(this.email.value === "" || this.password.value === ""){

                this.auth_message.innerHTML = "Please enter email or password";
                
            }
            
        },false)

    },

    validateSignupForm(){
        this.user_signup_submit_btn.addEventListener('click',(event)=>{
            event.preventDefault();

            alert("something happened   ")

            if(this.user_password.value !== this.user_confirm_password.value){

                this.auth_message.innerHTML = "Please enter same password";
                
            }
            
        },false)

    }
}

let auth = new signin_authentication();
auth.validateSigninForm();
auth.validateSignupForm();