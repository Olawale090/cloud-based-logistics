"use strict";

// import { load_user } from "./pipe";
// using ES5 structural design pattern to creating objects and API interaction

const account_profile = function(){

    this.username = document.querySelector(".profile_username");
    this.fullname = document.querySelector(".user_fullname");
    this.email = document.querySelector(".u_email");
    this.private_PIN = document.querySelector(".user_PIN");
    this.user_account_submit_btn = document.querySelector(".account_submit_btn");

    this.fileBtn = document.querySelector(".image_selector");
    this.picholder = document.querySelector(".user_image_placeholder");

    this.user_avatar = document.querySelector(".u_avatar");

    // this.loader = document.querySelector(".form_loader");
    
};

account_profile.prototype ={

    select_user_image(){
            this.fileBtn.addEventListener('change',()=>{
                let reader = new FileReader();
    
                reader.onload = ()=>{

                    let dataurl = reader.result;
                    this.picholder.src = `${dataurl}`;

                };
                
                reader.readAsDataURL(this.fileBtn.files[0]);

            });
    },

    load_user_data(){

        window.addEventListener('load',(event)=>{

            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('GET','../backend/user_account_carrier.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{
                if (xhr.status === 200) {

                    let data_parser = JSON.parse(xhr.responseText);

                    this.username.innerHTML = data_parser.fullname;
                    this.fullname.value = data_parser.fullname;
                    this.email.value = data_parser.email;
                    this.private_PIN.value = data_parser.private_pin;

                    if (data_parser.user_image_dir == null) {

                        this.user_avatar.src = "../assets/images/033-user.svg";

                    } else {

                        this.user_avatar.src = `${data_parser.user_image_dir}`;

                    }

                    console.log(data_parser);

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{
                console.error("ERROR IN SERVER RESPONSE",err);
            };

            xhr.send();

        },false);




    },

    account_profile_update(){

        this.user_account_submit_btn('click',(event)=>{

            event.preventDefault();
            const params = 'user_fullname='+this.username.value + '&user_email=' + this.email.value + '&user_PIN=' + this.private_PIN.value;

            const xhr = new XMLHttpRequest();
            xhr.open('GET','../backend/account_profile_setup.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

        },false);

    }

}

let account_profile_setup = new account_profile();
    account_profile_setup.select_user_image();
    account_profile_setup.load_user_data();