"use strict";

// using ES5 structural design pattern to creating objects and API interaction

const load_user = function(){
    
    // signup parameters
   
    this.username = document.querySelector(".profile_username");
    this.user_avatar = document.querySelector(".u_avatar");
    // this.user_signin_auth_message = document.querySelector(".signin_auth_message");
    // this.user_signin_submit_btn = document.querySelector(".signin_btn");
};

load_user.prototype ={
   
    user_details_mount(){

        window.addEventListener('load',(event)=>{

            event.preventDefault();

            
            const xhr = new XMLHttpRequest();
            xhr.open('GET','../backend/user_account_carrier.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{
                if (xhr.status === 200) {

                    this.username.innerHTML = xhr.responseText;
                    console.log(xhr);

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{
                console.error("ERROR IN SERVER RESPONSE",err);
            };

            xhr.send();
        });
    }

}

let user_binder = new load_user();
user_binder.user_details_mount();