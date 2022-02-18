"use strict";

const delivery_agent = function(){

    this.form = document.querySelector('.delivery_agent_registration');

    this.username = document.querySelector(".profile_username");
    this.user_avatar = document.querySelector(".user_image_placeholder");


    this.agentName = document.querySelector(".agent_name");
    this.agentEmail = document.querySelector(".agent_email");
    this.agentPhoneNumber = document.querySelector(".agent_phone_number");

    this.productName = document.querySelector(".product_name");
    this.productQuantity = document.querySelector(".product_quantity_input");

    this.agentImagePicker = document.querySelector(".agent_image_upload_button");
    this.agentImagePlaceholder = document.querySelector(".agent_image_placeholder");
    this.agentQRURL=document.querySelector(".qr_code_container");

    this.submitBtn = document.querySelector(".delivery_agent_submit_btn");

    this.form_notifier = document.querySelector(".agent_form_notifier");
    this.loader = document.querySelector(".form_loader");
    
};

delivery_agent.prototype ={

    select_agent_image(){

        this.agentImagePicker.addEventListener('change',()=>{

            let reader = new FileReader();
    
            reader.onload = ()=>{

                let dataurl = reader.result;
                this.agentImagePlaceholder.src = `${dataurl}`;

                let agent_image_notifier = document.querySelector(".agent_image_upload_notifier");

                agent_image_notifier.style.opacity = '0';

            };
                
            reader.readAsDataURL(this.agentImagePicker.files[0]);

        });
    },

    agent_folder_maker(){

        this.agentPhoneNumber.addEventListener("blur",()=>{

            if (this.agentName.value != "" || this.agentEmail.value != "" || this.agentPhoneNumber.value != "") {

                this.agentQRURL.value = `https://donlogistics.epizy.com/directories/agent_verification.php?agent_phone_number=${this.agentPhoneNumber.value}`;

                const params = 'agent_name='+this.agentName.value + '&agent_email='+this.agentEmail.value + '&agent_phone_number='+this.agentPhoneNumber.value;
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST','../backend/agent_folder_mkr.php',true);
                xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

                xhr.onload = ()=>{
                    if (xhr.status === 200) {
                        
                        console.log("File maker initiated...");
    
                    } else if(xhr.status === 404) {
    
                        console.error("FILE NOT FOUND");
    
                    }
                    
                };
    
                xhr.onerror = (err)=>{

                    console.error("ERROR IN SERVER RESPONSE",err);

                };
    
                xhr.send(params);

            } else {

                console.log(" Please fill the empty field(s) ");

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

    agent_image_upload(){

        this.agentImagePicker.addEventListener('change',(event)=>{

            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/agent_image_upload.php',true);  
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

                    let agent_image_notifier = document.querySelector(".agent_image_upload_notifier");
                    agent_image_notifier.innerHTML = xhr.responseText;

                    console.log(xhr.responseText);

                    if (xhr.responseText == " Picture updated successfully ") {

                        agent_image_notifier.style.color = "rgb(40, 230, 113)";

                    }else{
                        agent_image_notifier.innerHTML = "something went wrong";
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

    agent_details_update(){

        this.submitBtn.addEventListener('click',(event)=>{

            event.preventDefault();
            
            const params = 'agent_name='+this.agentName.value + '&agent_email='+this.agentEmail.value + '&agent_phone_number='+this.agentPhoneNumber.value + '&product_name='+this.productName.value + '&product_quantity='+this.productQuantity.value + '&agent_qr_code_string='+this.agentQRURL.value;
            
            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/agent_verification.php',true);
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
        this.agentPhoneNumber.addEventListener("blur",()=>{

            var qrcode = new QRCode(document.querySelector(".img_qr_code"), {
                width : 200,
                height : 200
            });

            function makeCode () {		
                var elText = document.getElementById("qr_code_placeholder");
                qrcode.makeCode(elText.value);

            }
        
            makeCode();

        },false);
    }

}

let delivery_agent_setup = new delivery_agent();

    delivery_agent_setup.select_agent_image();
    delivery_agent_setup.load_user_data();
    delivery_agent_setup.agent_folder_maker();
    delivery_agent_setup.agent_image_upload();
    delivery_agent_setup.agent_details_update();
    delivery_agent_setup.qrCodeGenerator();

const agent_input_validator = function(){

    this.agent_name_notifier = document.querySelector(".agent_name_error_notifier");
    this.agent_email_notifier = document.querySelector(".agent_email_error_notifier");
    this.agent_phone_number_notifier = document.querySelector(".agent_phone_number_error_notifier");
    this.product_name_notifier = document.querySelector(".p_name_error_notifier");
    this.product_quantity_notifier = document.querySelector(".p_quantity_error_notifier");
    this.agent_image_upload = document.querySelector(".agent_image_upload_notifier");

};

agent_input_validator.prototype  = Object.create(delivery_agent_setup);

agent_input_validator.prototype = {

    validate_inputs (){

        this.agentName.addEventListener("blur",()=>{
            
            if(this.agentName.value == ''){
                this.agent_name_notifier.style.opacity = "1";
            }else{
                this.agent_name_notifier.style.opacity = "0";
            }

        });

        this.agentName.addEventListener("input",()=>{
            
            this.agent_name_notifier.style.opacity = "0";

        },false);


        this.agentEmail.addEventListener("blur",()=>{
            
            if(this.agentEmail.value == ''){

                this.agent_email_notifier.style.opacity = "1";

            }else{

                this.agent_email_notifier.style.opacity = "0";

            }

        });

        this.agentEmail.addEventListener("input",()=>{
            
            this.agent_email_notifier.style.opacity = '0';

        },false);


        this.agentPhoneNumber.addEventListener("blur",()=>{

            if(this.agentPhoneNumber.value == ''){

                this.agent_phone_number_notifier.style.opacity = "1";

            }else{

                this.agent_phone_number_notifier.style.opacity = "0";

            }

        });

        this.agentPhoneNumber.addEventListener("input",()=>{
            
            this.agent_phone_number_notifier.style.opacity = '0';

        },false);


        this.productName.addEventListener("blur",()=>{
            
            if(this.productName.value == ''){

                this.product_name_notifier.style.opacity = "1";

            }else{

                this.product_name_notifier.style.opacity = "0";

            }

        });

        this.productName.addEventListener("input",()=>{
            
            this.product_name_notifier.style.opacity = '0';

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

    }

};

let validator = new agent_input_validator();
                Object.assign(validator, delivery_agent_setup);

    validator.validate_inputs();

