"use strict";

// using ES5 structural design pattern to creating objects and API interaction

export const load_user = function(){
    
    // signup parameters
    this.username = document.querySelector(".profile_username");
    this.user_avatar = document.querySelector(".u_avatar");

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

                    let data_parser = JSON.parse(xhr.responseText);

                    this.username.innerHTML = data_parser.fullname;

                    if (data_parser.user_image_dir == null) {

                        this.user_avatar.src = "../assets/images/033-user.svg";

                    } else {

                        this.user_avatar.src = `${data_parser.user_image_dir}`;

                    }

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