"use strict";


const product_delivery = function(){

    // this.form = document.querySelector('.user_profile_account');

    this.username = document.querySelector(".profile_username");
    this.user_avatar = document.querySelector(".user_image_placeholder");


    this.productName = document.querySelector(".product_name");
    this.productCategory = document.querySelector(".product_category");
    this.productQuantity = document.querySelector(".product_quantity");
    this.productDeliveryNumber = document.querySelector(".product_delivery_number");
    this.receiversMail = document.querySelector(".r_email");
    this.productImageSelection = document.querySelector(".product_upload_button");
    this.productQRURL = document.querySelector(".qr_code_container");

    this.productImagePlaceholder = document.querySelector(".p_image_placeholder");

    // this.fileBtn = document.querySelector(".image_selector");
    

    // this.user_avatar = document.querySelector(".u_avatar");

    // this.form_notifier = document.querySelector(".form_notifier");

    this.loader = document.querySelector(".form_loader");
    
};

product_delivery.prototype ={

    select_user_image(){
        this.productImageSelection.addEventListener('change',()=>{
                let reader = new FileReader();
    
                reader.onload = ()=>{

                    let dataurl = reader.result;
                    this.productImagePlaceholder.src = `${dataurl}`;

                };
                
                reader.readAsDataURL(this.productImageSelection.files[0]);

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

                    if (data_parser.user_img_dir == null || data_parser.user_img_dir == "") {

                        this.user_avatar.src = "../assets/images/033-user.svg";

                    } else {

                        this.user_avatar.src = `${data_parser.user_img_dir}`;

                    }

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

    product_image_upload(){

        this.fileBtn.addEventListener('change',(event)=>{

            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/user_picture_upload.php',true);  
            let file_data = new FormData(this.form);

            xhr.onloadstart = ()=>{

                this.loader.style.display = "block";
                
            };

            xhr.onprogress = ()=>{

                this.loader.style.display = "block";
                
            };

            xhr.onloadend = ()=>{

                this.loader.style.display = "none";
                
            };

            xhr.onload = ()=>{

                if (xhr.status === 200) {

                    this.form_notifier.innerHTML = xhr.responseText;
                    console.log(xhr.responseText);

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{

                console.error("ERROR IN SERVER RESPONSE",err);

            };

            xhr.send(file_data);

        },false);

    },

    account_profile_update(){

        this.user_account_submit_btn.addEventListener('click',(event)=>{

            event.preventDefault();
            
            const params = 'user_fullname='+this.fullname.value + '&user_email='+this.email.value + '&user_PIN='+this.private_PIN.value + '&user_avatar_upload_btn';

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/account_profile_setup.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{

                if (xhr.status === 200) {

                    this.form_notifier.innerHTML = xhr.responseText;
                    console.log(xhr.responseText);

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{

                console.error("ERROR IN SERVER RESPONSE",err);

            };

            xhr.send(params);

        },false);

    }

}

let product_delivery_setup = new product_delivery();
    product_delivery_setup.select_user_image();
    product_delivery_setup.load_user_data();
    // product_delivery_setup.account_profile_update();
    // product_delivery_setup.product_image_upload();