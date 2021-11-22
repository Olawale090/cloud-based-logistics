"use strict";

// using ES5 structural design pattern to creating objects and API interaction

const signin_authentication = function(){
    
    // signup parameters
   
    this.user_email = document.querySelector(".signin_email");
    this.user_password = document.querySelector(".signin_password");
    this.user_signin_auth_message = document.querySelector(".signin_auth_message");
    this.user_signin_submit_btn = document.querySelector(".signin_btn");
    
};

signin_authentication.prototype ={
   
    user_account_login(){

        this.user_signin_submit_btn.addEventListener('click',(event)=>{

            event.preventDefault();

            let params =  'user_signin_email=' + this.user_email.value + '&user_signin_password=' + this.user_password.value;
            const xhr = new XMLHttpRequest();
            xhr.open('POST','./backend/user_signin_auth.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{
                if (xhr.status === 200) {

                    this.user_signin_auth_message.innerHTML = xhr.responseText;
                    
                    console.log(xhr.responseText);
                    let extract = xhr.responseText.replace("\n","");
                    console.log(extract);
                    console.log(extract == xhr.responseText?true:false);

                    if (xhr.responseText == "Login successful") {
                        this.user_signup_auth_message.style.color = "#4675f8";
                        window.open('./directories/account_profile.html','Self');
                        console.log("working...");
                    }

                } else if(xhr.status === 404) {

                   window.open("../directories/pagenotfound.php","Self");
                   console.error("PAGE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{
                alert(err);
            };

            xhr.send(params);
        });
    }

}

let auth = new signin_authentication();
auth. user_account_login();