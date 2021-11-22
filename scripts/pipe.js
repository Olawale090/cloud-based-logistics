"use strict";

// using ES5 structural design pattern to creating objects and API interaction

const load_user = function(){
    
    // signup parameters
   
    this.username = document.querySelector(".profile_username");
    // this.user_password = document.querySelector(".signin_password");
    // this.user_signin_auth_message = document.querySelector(".signin_auth_message");
    // this.user_signin_submit_btn = document.querySelector(".signin_btn");
};

load_user.prototype ={
   
    user_details_mount(){

        window.addEventListener('load',(event)=>{

            event.preventDefault();

            
            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/user_account_carrier.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{
                if (xhr.status === 200) {
                    
                    var parsed = JSON.parse(xhr.responseText);

                    this.username.innerHTML = xhr.responseText;
                    // if(xhr.responseText !== pasrsed)
                    
                    console.log(parsed);

                    // if (xhr.responseText == 'Login successful') {
                    //     // this.user_signup_auth_message.style.color = "#4675f8";
                    //     window.open('../directories/account_profile.html','Self');
                    //     console.log("working...");
                    // }

                } else if(xhr.status === 404) {

                    alert("page not found");

                }
                
            };

            xhr.onerror = (err)=>{
                alert(err);
            };

            xhr.send();
        });
    }

}

let user_binder = new load_user();
user_binder.user_details_mount();