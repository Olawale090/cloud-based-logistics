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
};

signup_authentication.prototype ={
   
    user_registration(){

        this.user_signup_submit_btn.addEventListener('click',(event)=>{
            // console.log(this);
            event.preventDefault();

            let params = 'user_fullname=' + this.user_fullname.value + '&user_email=' + this.user_email.value + '&user_password=' + this.user_password.value + '&user_confirm_password=' + this.user_confirm_password.value;
            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/authentication.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{
                if (xhr.status === 200) {

                    this.user_signup_auth_message.innerHTML = xhr.responseText;
                    console.log(xhr.responseText);

                    if (this.user_signup_auth_message.innerHTML == "Form submitted successfuly") {
                        this.user_signup_auth_message.style.color = "#4675f8";
                        window.open('../directories/signin.html','Self');
                        alert("working...");
                    }else if(this.user_signup_auth_message.innerHTML !== "Form submitted successfuly"){
                        alert("error somewhere");
                    }

                } else if(xhr.status === 404) {

                    alert("page not found");

                }
                
            };

            xhr.onerror = (err)=>{
                alert(err);
            };

            xhr.send(params);
        });
    }

}

let auth = new signup_authentication();
auth.user_registration();