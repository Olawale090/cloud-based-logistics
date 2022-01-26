"use strict";

const product_delivery = function(){

    this.form = document.querySelector('.product_delivery_registration');

    this.username = document.querySelector(".profile_username");
    this.user_avatar = document.querySelector(".user_image_placeholder");


    this.productName = document.querySelector(".product_name");
    this.productCategory = document.querySelector(".product_category");
    this.productQuantity = document.querySelector(".product_quantity_input");

    this.productDeliveryNumber = document.querySelector(".product_delivery_number_input");
    this.deliveryNumberGenerator = document.querySelector(".number_generator");
    this.DNGplaceholder = document.querySelector(".number_value_placeholder"); 

    this.receiversMail = document.querySelector(".r_email");
    this.productImageSelection = document.querySelector(".product_upload_button");
    this.productQRURL = document.querySelector(".qr_code_container");

    this.productImagePlaceholder = document.querySelector(".p_image_placeholder");

    this.submitBtn = document.querySelector(".product_delivery_submit_btn");
    

    this.form_notifier = document.querySelector(".product_form_notifier");

    this.loader = document.querySelector(".form_loader");
    
};

product_delivery.prototype ={

    product_delivery_number_generator(){

        this.deliveryNumberGenerator.addEventListener("click",(event)=>{

            event.preventDefault();

            let numberGenerator = Math.floor(Math.random()* 999000000000 ) + 1000000000;
            
            this.DNGplaceholder.innerHTML = numberGenerator;
            this.productDeliveryNumber.value = numberGenerator;
            this.productDeliveryNumber.focus();

        },false);

    },

    select_product_image(){

        this.productImageSelection.addEventListener('change',()=>{

            let reader = new FileReader();
    
            reader.onload = ()=>{

                let dataurl = reader.result;
                this.productImagePlaceholder.src = `${dataurl}`;

                let product_image_notifier = document.querySelector(".p_image_upload_notifier");

                product_image_notifier.style.opacity = '0';

            };
                
            reader.readAsDataURL(this.productImageSelection.files[0]);

        });
    },

    product_folder_maker(){

        this.productDeliveryNumber.addEventListener("blur",()=>{

            if (this.productName.value != "" || this.productCategory.value != "" || this.productQuantity.value != "" || this.productDeliveryNumber.value != "") {

                this.productQRURL.value = `https://donlogistics.epizy.com/directories/order_verification.php?product_delivery_number=${this.productDeliveryNumber.value}`;

                const params = 'product_name='+this.productName.value + '&product_category='+this.productCategory.value + '&product_quantity='+this.productQuantity.value + '&product_delivery_number='+this.productDeliveryNumber.value;
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST','../backend/product_folder_mkr.php',true);
                xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

                xhr.onload = ()=>{
                    if (xhr.status === 200) {
                        
                        console.log("name marked");
                        console.log(xhr.responseText);
    
                    } else if(xhr.status === 404) {
    
                        console.error("FILE NOT FOUND");
    
                    }
                    
                };
    
                xhr.onerror = (err)=>{
                    console.error("ERROR IN SERVER RESPONSE",err);
                };
    
                xhr.send(params);

            } else {
                console.log("Please fill the empty field");
            }


        },false);


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

        this.productImageSelection.addEventListener('change',(event)=>{

            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/product_image_upload.php',true);  
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

                    let product_image_notifier = document.querySelector(".p_image_upload_notifier");
                    product_image_notifier.innerHTML = xhr.responseText;

                    console.log(xhr.responseText);

                    if (xhr.responseText == " Picture updated successfully ") {

                        product_image_notifier.style.color = "rgb(40, 230, 113)";

                    }else{
                        product_image_notifier.innerHTML = "something went wrong";
                    }

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

    product_details_update(){

        this.submitBtn.addEventListener('click',(event)=>{

            event.preventDefault();
            
            const params = 'product_name='+this.productName.value + '&product_category='+this.productCategory.value + '&product_quantity='+this.productQuantity.value + '&product_delivery_number='+this.productDeliveryNumber.value + '&r_email='+this.receiversMail.value + '&qr_code_string='+this.productQRURL.value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/product_delivery_setup.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{

                if (xhr.status === 200) {
                    
                    this.form_notifier.innerHTML = xhr.responseText;

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{

                console.error("ERROR IN SERVER RESPONSE",err);

            };

            xhr.send(params);

        },false);

    },

    qrCodeGenerator(){
        this.productDeliveryNumber.addEventListener("blur",()=>{

            var qrcode = new QRCode(document.querySelector(".img_qr_code"), {
                width : 200,
                height : 200
            });

            function makeCode () {		
                var elText = document.getElementById("text");
                qrcode.makeCode(elText.value);

            }
        
            makeCode();

        },false);
    }

}

let product_delivery_setup = new product_delivery();

    product_delivery_setup.product_delivery_number_generator();
    product_delivery_setup.select_product_image();
    product_delivery_setup.load_user_data();
    product_delivery_setup.product_folder_maker();
    product_delivery_setup.product_image_upload();
    product_delivery_setup.product_details_update();
    product_delivery_setup.qrCodeGenerator();

const product_input_validator = function(){

    this.product_name_notifier = document.querySelector(".p_name_error_notifier");
    this.product_category_notifier = document.querySelector(".p_category_error_notifier");
    this.product_quantity_notifier = document.querySelector(".p_quantity_error_notifier ");
    this.product_delivery_number_notifier = document.querySelector(".product_delivery_number");
    this.product_receiver_email_notifier = document.querySelector(".r_email_error_notifier");
    this.product_image = document.querySelector(".p_image_upload_notifier");
    this.product_qr_url_notifier = document.querySelector(".p_name_error_notifier");

};

product_input_validator.prototype  = Object.create(product_delivery_setup);

product_input_validator.prototype = {

    validate_inputs (){

        this.productName.addEventListener("blur",()=>{
            
            if(this.productName.value == ''){
                this.product_name_notifier.style.opacity = "1";
            }else{
                this.product_name_notifier.style.opacity = "0";
            }

        });

        this.productName.addEventListener("input",()=>{
            
            this.product_name_notifier.style.opacity = "0";

        },false);


        this.productCategory.addEventListener("blur",()=>{
            
            if(this.productCategory.value == ''){

                this.product_category_notifier.style.opacity = "1";

            }else{

                this.product_category_notifier.style.opacity = "0";

            }

        });

        this.productCategory.addEventListener("input",()=>{
            
            this.product_category_notifier.style.opacity = '0';

        },false);

        this.productQuantity.addEventListener("blur",()=>{

            if(this.productQuantity.value == ''){

                this.product_quantity_notifier.style.opacity = "1";

            }else{

                this.product_quantity_notifier.style.opacity = "0";

            }

        });

        this.productQuantity.addEventListener("input",()=>{
            
            this.product_quantity_notifier.style.opacity = '0';

        },false);

         this.receiversMail.addEventListener("blur",()=>{
            
            if(this.receiversMail.value == ''){

                this.product_receiver_email_notifier.style.opacity = "1";

            }else{

                this.product_receiver_email_notifier.style.opacity = "0";

            }

        });

        this.receiversMail.addEventListener("input",()=>{
            
            this.product_receiver_email_notifier.style.opacity = '0';

        },false);


    }

};


let validator = new product_input_validator();
                Object.assign(validator, product_delivery_setup);

    validator.validate_inputs();

